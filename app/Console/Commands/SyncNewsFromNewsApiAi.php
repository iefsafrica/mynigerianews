<?php

namespace App\Console\Commands;

use App\Models\News;
use App\Models\Newscategory;
use App\Models\Newsspeciality;
use App\Models\Newssubcategory;
use App\Models\User;
use App\Services\NewsApiAiService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SyncNewsFromNewsApiAi extends Command
{
    protected $signature = 'newsapi:sync
                            {--per-category= : Number of articles to pull for each category}
                            {--update-existing : Update existing rows when title + date matches}
                            {--dry-run : Fetch and parse without writing to database}';

    protected $description = 'Sync news articles from newsapi.ai into the local news table';

    public function handle(NewsApiAiService $newsApiAiService)
    {
        if (empty(config('services.newsapi_ai.api_key'))) {
            $this->error('NEWSAPIAI_API_KEY is missing. Set it in .env first.');
            return 1;
        }

        $user = User::where('user_type', '0')->first() ?: User::first();
        if (! $user) {
            $this->error('No user found. Create at least one user before syncing.');
            return 1;
        }

        $specialityId = Newsspeciality::query()->value('id');
        if (! $specialityId) {
            $this->error('No news speciality found. Please seed/migrate newsspecialities first.');
            return 1;
        }

        $this->seedDefaultCategories($user->id);
        $categories = Newscategory::where('type', 'news')->get();
        if ($categories->isEmpty()) {
            $this->error('No news categories found. Please create categories in admin first.');
            return 1;
        }

        $perCategory = (int) ($this->option('per-category') ?: config('services.newsapi_ai.default_limit', 10));
        $updateExisting = (bool) $this->option('update-existing');
        $dryRun = (bool) $this->option('dry-run');

        $inserted = 0;
        $updated = 0;
        $skipped = 0;

        foreach ($categories as $category) {
            $this->info('Fetching: '.$category->name);
            $articles = $newsApiAiService->fetchArticles($category->name, $perCategory);
            if ($articles->isEmpty()) {
                continue;
            }

            $subcategory = Newssubcategory::firstOrCreate(
                [
                    'category_id' => $category->id,
                    'name' => $category->name,
                ],
                [
                    'user_id' => $user->id,
                ]
            );

            foreach ($articles as $article) {
                $title = $this->clip(strip_tags($article['title']), 255);
                if ($title === '') {
                    $skipped++;
                    continue;
                }

                $publishDate = $this->safeDate($article['published_at']);
                $existing = News::where('title', $title)->whereDate('date', $publishDate)->first();

                if ($existing && ! $updateExisting) {
                    $skipped++;
                    continue;
                }

                $summary = $this->clip(strip_tags($article['summary']), 255);
                if ($summary === '') {
                    $summary = $this->clip(strip_tags($article['description']), 255);
                }

                $description = trim((string) $article['description']);
                if ($description === '') {
                    $description = $summary;
                }

                $imageJson = '';
                if (! empty($article['image_url'])) {
                    $imageJson = $this->downloadImageAsJson($article['image_url']);
                }

                if ($dryRun) {
                    $this->line(' - '.$title);
                    continue;
                }

                $news = $existing ?: new News();
                $news->title = $title;
                $news->summary = $summary;
                $news->description = $description;
                $news->subcategory_id = $subcategory->id;
                $news->date = $publishDate;
                $news->tags = $this->clip(implode(',', array_filter([$category->name, $article['source']])), 50);
                $news->speciality_id = $specialityId;
                $news->reporter_id = $user->id;
                if ($imageJson !== '') {
                    $news->image = $imageJson;
                } elseif (! $existing) {
                    $news->image = '';
                }
                $news->user_id = $user->id;
                $news->status = 1;
                $news->breaking_news = 0;
                $news->meta_keyword = $this->clip(implode(',', array_filter([$category->name, $article['source']])), 255);
                $news->meta_description = $this->clip($summary, 255);
                $news->save();

                if ($existing) {
                    $updated++;
                } else {
                    $inserted++;
                    Newscategory::where('id', $category->id)->increment('post_counter');
                }
            }
        }

        $this->info('newsapi.ai sync complete.');
        $this->line('Inserted: '.$inserted);
        $this->line('Updated: '.$updated);
        $this->line('Skipped: '.$skipped);

        return 0;
    }

    protected function safeDate($date): string
    {
        try {
            return Carbon::parse($date)->toDateString();
        } catch (\Throwable $e) {
            return now()->toDateString();
        }
    }

    protected function downloadImageAsJson($url): string
    {
        try {
            $response = Http::timeout(20)->get($url);
            if (! $response->successful()) {
                return '';
            }

            $binary = $response->body();
            if ($binary === '') {
                return '';
            }

            $path = (string) parse_url($url, PHP_URL_PATH);
            $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            if (! in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true)) {
                $extension = 'jpg';
            }

            $fileName = 'maannewsimage'.now()->format('dmY_His').'_'.Str::random(8).'.'.$extension;
            $relativePath = 'public/uploads/images/newsimages/'.$fileName;
            $absolutePath = base_path($relativePath);

            $directory = dirname($absolutePath);
            if (! File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            File::put($absolutePath, $binary);
            return json_encode([$relativePath]);
        } catch (\Throwable $e) {
            return '';
        }
    }

    protected function seedDefaultCategories($userId): void
    {
        $defaults = [
            'Business',
            'Sports',
            'Politics',
            'Entertainment',
            'National',
            'World',
            'Travel',
            'Investigation',
            'Lifestyle',
            'Technology',
        ];

        foreach ($defaults as $name) {
            Newscategory::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'type' => 'news',
                    'image' => '',
                    'post_counter' => 0,
                    'menu_publish' => 1,
                    'user_id' => $userId,
                ]
            );
        }
    }

    protected function clip($value, $limit): string
    {
        $value = trim((string) $value);

        if (function_exists('mb_substr')) {
            return mb_substr($value, 0, $limit);
        }

        return substr($value, 0, $limit);
    }
}

