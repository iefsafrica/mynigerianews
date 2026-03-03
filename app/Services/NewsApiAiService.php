<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class NewsApiAiService
{
    protected $apiKey;
    protected $endpoint;

    public function __construct()
    {
        $this->apiKey = (string) config('services.newsapi_ai.api_key');
        $this->endpoint = (string) config('services.newsapi_ai.endpoint');
    }

    public function fetchArticles($limit = 20, $keyword = null, $sinceHours = null): Collection
    {
        if ($this->apiKey === '' || $this->endpoint === '') {
            Log::warning('NewsAPI import skipped: missing API key or endpoint.');
            return collect();
        }

        $limit = max(1, min((int) $limit, 100));
        $queryKeyword = trim((string) ($keyword ?: config('services.newsapi_ai.default_keyword', 'Nigeria')));
        $sinceHours = (int) ($sinceHours ?? config('services.newsapi_ai.default_since_hours', 24));
        $sinceHours = max(1, min($sinceHours, 168));
        $dateStart = Carbon::now()->subHours($sinceHours)->format('Y-m-d');

        $payload = [
            'apiKey' => $this->apiKey,
            'query' => [
                '$query' => [
                    '$and' => [
                        ['keyword' => $queryKeyword],
                        ['lang' => config('services.newsapi_ai.default_lang', 'eng')],
                        ['dateStart' => $dateStart],
                    ],
                ],
            ],
            'resultType' => 'articles',
            'articlesSortBy' => 'date',
            'articlesSortByAsc' => false,
            'articlesCount' => $limit,
            'includeArticleImage' => true,
            'includeArticleBody' => true,
        ];

        try {
            $response = Http::timeout(30)->acceptJson()->post($this->endpoint, $payload);
        } catch (\Throwable $exception) {
            Log::error('NewsAPI request failed.', ['error' => $exception->getMessage()]);
            return collect();
        }

        if (! $response->successful()) {
            Log::error('NewsAPI request failed.', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return collect();
        }

        $articles = $this->extractArticles((array) $response->json());

        return collect($articles)
            ->map(function ($article) {
                return $this->normalizeArticle((array) $article);
            })
            ->filter(function ($article) {
                return ! empty($article['title']);
            })
            ->values();
    }

    protected function extractArticles(array $payload): array
    {
        if (isset($payload['articles']['results']) && is_array($payload['articles']['results'])) {
            return $payload['articles']['results'];
        }

        if (isset($payload['articles']) && is_array($payload['articles'])) {
            return $payload['articles'];
        }

        if (isset($payload['results']) && is_array($payload['results'])) {
            return $payload['results'];
        }

        if (isset($payload['data']['articles']) && is_array($payload['data']['articles'])) {
            return $payload['data']['articles'];
        }

        return [];
    }

    protected function normalizeArticle(array $article): array
    {
        $title = $this->readText(
            $article['title'] ?? $article['cleanTitle'] ?? null
        );

        $summary = $this->readText(
            $article['description'] ?? $article['body'] ?? $article['summary'] ?? null
        );

        $description = $this->readText(
            $article['body'] ?? $article['description'] ?? $article['summary'] ?? null
        );

        $sourceName = $this->readText(
            $article['source']['title'] ?? $article['source']['name'] ?? $article['source']['uri'] ?? null
        );

        $imageUrl = $this->readText(
            $article['image'] ?? $article['urlToImage'] ?? null
        );

        $url = $this->readText(
            $article['url'] ?? $article['link'] ?? null
        );

        $publishedAt = $this->readText(
            $article['dateTimePub'] ?? $article['publishedAt'] ?? $article['dateTime'] ?? $article['date'] ?? null
        );

        $tags = [];
        if (isset($article['concepts']) && is_array($article['concepts'])) {
            foreach ($article['concepts'] as $concept) {
                $name = $this->readText($concept['label'] ?? $concept['name'] ?? null);
                if ($name !== '') {
                    $tags[] = $name;
                }
            }
        }

        return [
            'title' => trim($title),
            'summary' => trim($summary),
            'description' => trim($description),
            'source_name' => trim($sourceName),
            'image_url' => trim($imageUrl),
            'url' => trim($url),
            'published_at' => trim($publishedAt),
            'tags' => $tags,
        ];
    }

    protected function readText($value): string
    {
        if (is_string($value)) {
            return $value;
        }

        if (is_array($value)) {
            if (isset($value['eng']) && is_string($value['eng'])) {
                return $value['eng'];
            }

            foreach ($value as $item) {
                if (is_string($item) && $item !== '') {
                    return $item;
                }
            }
        }

        return '';
    }
}
