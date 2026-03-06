<?php

namespace App\Console\Commands;

use App\Models\News;
use App\Models\Newscategory;
use App\Models\Newsspeciality;
use App\Models\Newssubcategory;
use App\Models\User;
use App\Services\NewsApiAiService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ImportNewsFromNewsApi extends Command
{
    protected $signature = 'newsapi:import
                            {--limit=20 : Number of articles to fetch}
                            {--since-hours=24 : Fetch only recent articles from this many hours back}
                            {--keyword= : Keyword to query in NewsAPI}
                            {--category= : Existing local category name}
                            {--subcategory= : Existing local subcategory name}
                            {--status=1 : Publish status (1=published, 0=draft)}
                            {--sections : Import across homepage section categories}
                            {--dry-run : Preview import without writing to database}';

    protected $description = 'Import news articles from NewsAPI into local news table';

    public function handle(NewsApiAiService $service)
    {
        $userId = $this->resolveUserId();
        $reporterId = $this->resolveReporterId($userId);
        $specialityId = $this->resolveSpecialityId();

        if (! $userId || ! $reporterId || ! $specialityId) {
            $this->error('Missing user/reporter/speciality records required for import.');
            return self::FAILURE;
        }

        $isDryRun = (bool) $this->option('dry-run');
        $status = (int) $this->option('status') === 1 ? 1 : 0;
        $totalInserted = 0;
        $totalSkipped = 0;
        $totalFetched = 0;

        $categoryOption = trim((string) $this->option('category'));
        $keywordOption = trim((string) $this->option('keyword'));
        $useSectionImport = (bool) $this->option('sections') || ($categoryOption === '' && $keywordOption === '');

        if ($useSectionImport) {
            $sectionMap = $this->resolveSectionKeywords();
            foreach ($sectionMap as $categoryName => $keyword) {
                $category = $this->resolveCategory($categoryName);
                if (! $category) {
                    $this->warn('Skipping section "' . $categoryName . '" (category not found).');
                    continue;
                }

                $subcategory = $this->resolveSubcategory($category->id, (string) $this->option('subcategory'));
                if (! $subcategory) {
                    $this->warn('Skipping section "' . $categoryName . '" (subcategory not found).');
                    continue;
                }

                $articles = $service->fetchArticles(
                    (int) $this->option('limit'),
                    $keyword,
                    (int) $this->option('since-hours')
                );
                $totalFetched += $articles->count();

                if ($articles->isEmpty()) {
                    $this->warn('No articles returned for section "' . $categoryName . '".');
                    continue;
                }

                [$inserted, $skipped] = $this->storeArticles(
                    $articles,
                    $subcategory->id,
                    $category->id,
                    $status,
                    $userId,
                    $reporterId,
                    $specialityId,
                    $isDryRun
                );

                $totalInserted += $inserted;
                $totalSkipped += $skipped;
                $this->info('Section ' . $categoryName . ': inserted=' . $inserted . ', skipped=' . $skipped . ', fetched=' . $articles->count());
            }
        } else {
            $category = $this->resolveCategory($categoryOption);
            if (! $category) {
                $this->error('No news category found. Create at least one category in admin first.');
                return self::FAILURE;
            }

            $subcategory = $this->resolveSubcategory($category->id, (string) $this->option('subcategory'));
            if (! $subcategory) {
                $this->error('No news subcategory found for selected category. Create one subcategory first.');
                return self::FAILURE;
            }

            $queryKeyword = $keywordOption !== '' ? $keywordOption : $category->name . ' Nigeria';
            $articles = $service->fetchArticles(
                (int) $this->option('limit'),
                $queryKeyword,
                (int) $this->option('since-hours')
            );
            $totalFetched += $articles->count();

            if ($articles->isEmpty()) {
                $this->warn('No articles returned from NewsAPI.');
                return self::SUCCESS;
            }

            [$inserted, $skipped] = $this->storeArticles(
                $articles,
                $subcategory->id,
                $category->id,
                $status,
                $userId,
                $reporterId,
                $specialityId,
                $isDryRun
            );
            $totalInserted += $inserted;
            $totalSkipped += $skipped;
        }

        $mode = $isDryRun ? 'DRY RUN' : 'IMPORT';
        $this->info($mode . ' finished: inserted=' . $totalInserted . ', skipped=' . $totalSkipped . ', fetched=' . $totalFetched);

        return self::SUCCESS;
    }

    protected function storeArticles($articles, $subcategoryId, $categoryId, $status, $userId, $reporterId, $specialityId, $isDryRun)
    {
        $inserted = 0;
        $skipped = 0;

        foreach ($articles as $article) {
            $title = $this->limitText(trim((string) $article['title']), 240);
            if ($title === '') {
                $skipped++;
                continue;
            }

            $publishedDate = $this->normalizeDate($article['published_at']);
            $sourceUrl = trim((string) $article['url']);
            $summary = $this->buildSummary((string) $article['summary'], (string) $article['description']);
            $description = $this->buildDescription((string) $article['description'], (string) $article['summary'], $sourceUrl);

            $exists = News::query()
                ->whereDate('date', $publishedDate)
                ->where(function ($query) use ($title, $sourceUrl) {
                    $query->where('title', $title);
                    if ($sourceUrl !== '') {
                        $query->orWhere('meta_description', $this->limitText($sourceUrl, 255));
                    }
                })
                ->exists();

            if ($exists) {
                $skipped++;
                continue;
            }

            $imageJson = $this->downloadImageAsJson((string) $article['image_url']);
            $metaDescription = $this->limitText($sourceUrl !== '' ? $sourceUrl : $summary, 255);
            $metaKeyword = $this->limitText($this->buildMetaKeywords($article), 255);

            if ($isDryRun) {
                $inserted++;
                continue;
            }

            News::create([
                'subcategory_id' => $subcategoryId,
                'title' => $title,
                'summary' => $summary,
                'description' => $description,
                'status' => $status,
                'breaking_news' => 0,
                'date' => $publishedDate,
                'tags' => 'newsapi',
                'speciality_id' => $specialityId,
                'reporter_id' => $reporterId,
                'image' => $imageJson,
                'user_id' => $userId,
                'archive' => 0,
                'viewers' => 0,
                'meta_keyword' => $metaKeyword,
                'meta_description' => $metaDescription,
            ]);

            $inserted++;
        }

        if (! $isDryRun && $inserted > 0 && $categoryId) {
            Newscategory::where('id', $categoryId)->increment('post_counter', $inserted);
        }

        return [$inserted, $skipped];
    }

    protected function resolveCategory($name)
    {
        $query = Newscategory::query()->where('type', 'news');
        if ($name !== '') {
            $query->where('name', $name);
        }

        return $query->first() ?: Newscategory::where('type', 'news')->first();
    }

    protected function resolveSubcategory($categoryId, $name)
    {
        $query = Newssubcategory::query()->where('category_id', $categoryId);
        if ($name !== '') {
            $query->where('name', $name);
        }

        return $query->first() ?: Newssubcategory::where('category_id', $categoryId)->first();
    }

    protected function resolveSectionKeywords()
    {
        $raw = (string) env(
            'NEWSAPIAI_SECTION_KEYWORDS',
            'National:Nigeria|World:World Nigeria|Politics:Nigerian politics|Lifestyle:Nigerian lifestyle|Entertainment:Nigerian entertainment|Sports:Nigerian sports|Technology:Nigerian technology|Business:Nigerian business'
        );

        $map = [];
        foreach (explode('|', $raw) as $entry) {
            $entry = trim($entry);
            if ($entry === '' || strpos($entry, ':') === false) {
                continue;
            }

            [$category, $keyword] = array_map('trim', explode(':', $entry, 2));
            if ($category !== '' && $keyword !== '') {
                $map[$category] = $keyword;
            }
        }

        return $map;
    }

    protected function resolveUserId()
    {
        $configured = (int) env('NEWSAPI_IMPORT_USER_ID', 0);
        if ($configured > 0 && User::where('id', $configured)->exists()) {
            return $configured;
        }

        return (int) User::orderBy('id')->value('id');
    }

    protected function resolveReporterId($fallbackUserId)
    {
        $configured = (int) env('NEWSAPI_IMPORT_REPORTER_ID', 0);
        if ($configured > 0 && User::where('id', $configured)->exists()) {
            return $configured;
        }

        $reporterId = User::where('user_type', '0')->orderBy('id')->value('id');
        if ($reporterId) {
            return (int) $reporterId;
        }

        return (int) $fallbackUserId;
    }

    protected function resolveSpecialityId()
    {
        $configured = (int) env('NEWSAPI_IMPORT_SPECIALITY_ID', 0);
        if ($configured > 0 && Newsspeciality::where('id', $configured)->exists()) {
            return $configured;
        }

        $noneId = Newsspeciality::where('name', 'None')->value('id');
        if ($noneId) {
            return (int) $noneId;
        }

        return (int) Newsspeciality::orderBy('id')->value('id');
    }

    protected function normalizeDate($value)
    {
        try {
            if ($value) {
                return Carbon::parse($value)->format('Y-m-d');
            }
        } catch (\Throwable $exception) {
            // Fall back to current date if parsing fails.
        }

        return now()->format('Y-m-d');
    }

    protected function buildSummary($summary, $description)
    {
        $candidate = trim($summary) !== '' ? trim($summary) : trim($description);
        if ($candidate === '') {
            $candidate = 'Imported from NewsAPI.';
        }

        return $this->limitText(strip_tags($candidate), 255);
    }

    protected function buildDescription($description, $summary, $sourceUrl)
    {
        $body = trim($description) !== '' ? trim($description) : trim($summary);
        if ($body === '') {
            $body = 'Imported from NewsAPI.';
        }

        if ($sourceUrl !== '') {
            $body .= "\n\nSource: " . $sourceUrl;
        }

        return $body;
    }

    protected function limitText($text, $limit)
    {
        $text = (string) $text;
        $limit = (int) $limit;

        if ($limit <= 0 || $text === '') {
            return '';
        }

        if (function_exists('mb_strimwidth')) {
            return rtrim(mb_strimwidth($text, 0, $limit, '', 'UTF-8'));
        }

        if (strlen($text) <= $limit) {
            return $text;
        }

        return rtrim(substr($text, 0, $limit));
    }

    protected function buildMetaKeywords(array $article)
    {
        $keywords = [];

        if (! empty($article['source_name'])) {
            $keywords[] = (string) $article['source_name'];
        }

        if (! empty($article['tags']) && is_array($article['tags'])) {
            foreach ($article['tags'] as $tag) {
                if (is_string($tag) && trim($tag) !== '') {
                    $keywords[] = trim($tag);
                }
            }
        }

        $keywords[] = 'newsapi';
        $keywords[] = 'nigeria';

        return implode(', ', array_unique($keywords));
    }

    protected function downloadImageAsJson($imageUrl)
    {
        if (trim($imageUrl) === '') {
            return $this->defaultImageJson();
        }

        try {
            $response = Http::timeout(20)->get($imageUrl);
            if (! $response->successful()) {
                return $this->defaultImageJson();
            }

            $contentType = (string) $response->header('Content-Type');
            if (strpos($contentType, 'image/') !== 0) {
                return $this->defaultImageJson();
            }

            $extension = 'jpg';
            if (strpos($contentType, 'png') !== false) {
                $extension = 'png';
            } elseif (strpos($contentType, 'webp') !== false) {
                $extension = 'webp';
            }

            $relativePath = 'public/uploads/images/newsimages/newsapi_' . md5($imageUrl) . '.' . $extension;
            $absolutePath = base_path($relativePath);

            File::ensureDirectoryExists(dirname($absolutePath));
            File::put($absolutePath, $response->body());

            return json_encode([$relativePath]);
        } catch (\Throwable $exception) {
            return $this->defaultImageJson();
        }
    }

    protected function defaultImageJson()
    {
        $fallbackPath = trim((string) env('NEWS_DEFAULT_IMAGE', 'maan/images/default_image.png'));
        return json_encode([$fallbackPath]);
    }
}
