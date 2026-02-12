<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class NewsApiAiService
{
    public function fetchArticles($categoryName = null, $limit = null): Collection
    {
        $apiKey = config('services.newsapi_ai.api_key');
        $endpoint = config('services.newsapi_ai.endpoint');

        if (empty($apiKey) || empty($endpoint)) {
            return collect();
        }

        $limit = (int) ($limit ?: config('services.newsapi_ai.default_limit', 10));
        $language = config('services.newsapi_ai.default_language', 'eng');
        $location = config('services.newsapi_ai.default_location', 'Nigeria');
        $keyword = trim(implode(' ', array_filter([$categoryName, $location])));

        $payload = [
            'query' => [
                '$query' => [
                    '$and' => [
                        [
                            '$or' => [
                                ['keyword' => $keyword, 'keywordLoc' => 'title'],
                                ['keyword' => $keyword, 'keywordLoc' => 'body'],
                            ],
                        ],
                        ['lang' => $language],
                    ],
                ],
            ],
            'resultType' => 'articles',
            'articlesSortBy' => 'date',
            'articlesCount' => max($limit, 1),
            'includeArticleCategories' => true,
            'apiKey' => $apiKey,
        ];

        try {
            $response = Http::timeout(20)->asJson()->post($endpoint, $payload);

            if (! $response->successful()) {
                return collect();
            }

            $results = data_get($response->json(), 'articles.results', []);
            if (! is_array($results)) {
                return collect();
            }

            return collect($results)
                ->map(function ($article) {
                    $title = trim((string) data_get($article, 'title', data_get($article, 'headline', '')));
                    $description = trim((string) data_get($article, 'body', data_get($article, 'description', '')));
                    $summary = trim((string) data_get($article, 'summary', ''));
                    $publishedAt = data_get($article, 'dateTimePub', data_get($article, 'publishedAt', data_get($article, 'date')));
                    $sourceTitle = trim((string) data_get($article, 'source.title', data_get($article, 'source.name', '')));
                    $url = trim((string) data_get($article, 'url', ''));
                    $imageUrl = trim((string) data_get($article, 'image', data_get($article, 'urlToImage', '')));

                    if ($summary === '') {
                        $summary = Str::limit(strip_tags($description), 280, '...');
                    }

                    if ($description === '') {
                        $description = $summary;
                    }

                    return [
                        'external_id' => (string) data_get($article, 'uri', sha1($title.$publishedAt.$url)),
                        'title' => $title,
                        'summary' => $summary,
                        'description' => $description,
                        'published_at' => $this->normalizeDate($publishedAt),
                        'image_url' => $imageUrl,
                        'source' => $sourceTitle,
                        'url' => $url,
                    ];
                })
                ->filter(function ($article) {
                    return $article['title'] !== '';
                })
                ->values();
        } catch (\Throwable $e) {
            return collect();
        }
    }

    protected function normalizeDate($date): string
    {
        if (empty($date)) {
            return now()->toDateString();
        }

        try {
            return Carbon::parse($date)->toDateString();
        } catch (\Throwable $e) {
            return now()->toDateString();
        }
    }
}

