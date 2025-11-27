<?php

namespace Database\Seeders;

use App\Models\AdSpaces;
use Arr;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultAdSeederTheme1 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Theme 1
        $ads = [
            [
                'ad_spaces' => AdSpaces::INDEX_TOP_THEME_1,
                'ad_view' => AdSpaces::DESKTOP,
                'ad_url' => 'https://codecanyon.net/item/infynews-laravel-news-and-magazines-blog-articles-php-script/38138839',
            ],
            [
                'ad_spaces' => AdSpaces::INDEX_TOP_THEME_1,
                'ad_view' => AdSpaces::MOBILE,
                'ad_url' => 'https://codecanyon.net/item/infynews-laravel-news-and-magazines-blog-articles-php-script/38138839',
            ],
            [
                'ad_spaces' => AdSpaces::INDEX_BOTTOM_THEME_1,
                'ad_view' => AdSpaces::DESKTOP,
                'ad_url' => 'https://codecanyon.net/item/infynews-laravel-news-and-magazines-blog-articles-php-script/38138839',
            ],
            [
                'ad_spaces' => AdSpaces::INDEX_BOTTOM_THEME_1,
                'ad_view' => AdSpaces::MOBILE,
                'ad_url' => 'https://codecanyon.net/item/infynews-laravel-news-and-magazines-blog-articles-php-script/38138839',
            ],
            [
                'ad_spaces' => AdSpaces::POST_DETAILS_THEME_1,
                'ad_view' => AdSpaces::DESKTOP,
                'ad_url' => 'https://codecanyon.net/item/infynews-laravel-news-and-magazines-blog-articles-php-script/38138839',
            ],
            [
                'ad_spaces' => AdSpaces::POST_DETAILS_THEME_1,
                'ad_view' => AdSpaces::MOBILE,
                'ad_url' => 'https://codecanyon.net/item/infynews-laravel-news-and-magazines-blog-articles-php-script/38138839',
            ],
            [
                'ad_spaces' => AdSpaces::ALL_DETAILS_SIDE_THEME_1,
                'ad_view' => AdSpaces::MOBILE,
                'ad_url' => 'https://codecanyon.net/item/infynews-laravel-news-and-magazines-blog-articles-php-script/38138839',
            ],
            [
                'ad_spaces' => AdSpaces::ALL_DETAILS_POPULAR_NEWS_THEME_1,
                'ad_view' => AdSpaces::DESKTOP,
                'ad_url' => 'https://codecanyon.net/item/infynews-laravel-news-and-magazines-blog-articles-php-script/38138839',
            ],
            [
                'ad_spaces' => AdSpaces::ALL_DETAILS_POPULAR_NEWS_THEME_1,
                'ad_view' => AdSpaces::MOBILE,
                'ad_url' => 'https://codecanyon.net/item/infynews-laravel-news-and-magazines-blog-articles-php-script/38138839',
            ],
            [
                'ad_spaces' => AdSpaces::CATEGORIES_THEME_1,
                'ad_view' => AdSpaces::DESKTOP,
                'ad_url' => 'https://codecanyon.net/item/infynews-laravel-news-and-magazines-blog-articles-php-script/38138839',
            ],
            [
                'ad_spaces' => AdSpaces::CATEGORIES_THEME_1,
                'ad_view' => AdSpaces::MOBILE,
                'ad_url' => 'https://codecanyon.net/item/infynews-laravel-news-and-magazines-blog-articles-php-script/38138839',
            ],
        ];

        foreach ($ads as $ad) {
            $postInputArray = Arr::only($ad, [
                'ad_spaces', 'ad_view', 'ad_url',
            ]);
            $newPost = AdSpaces::create($postInputArray);
        }
    }
}
