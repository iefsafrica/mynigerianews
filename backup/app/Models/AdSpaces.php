<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\AdSpaces
 *
 * @property int $id
 * @property int $ad_spaces
 * @property int $ad_view
 * @property string $ad_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $ad_banner
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 *
 * @method static Builder|AdSpaces newModelQuery()
 * @method static Builder|AdSpaces newQuery()
 * @method static Builder|AdSpaces query()
 * @method static Builder|AdSpaces whereAdSpaces($value)
 * @method static Builder|AdSpaces whereAdUrl($value)
 * @method static Builder|AdSpaces whereAdView($value)
 * @method static Builder|AdSpaces whereCreatedAt($value)
 * @method static Builder|AdSpaces whereId($value)
 * @method static Builder|AdSpaces whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class AdSpaces extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $fillable = [
        'ad_spaces',
        'ad_view',
        'ad_url',
        'code',
    ];

    const IMAGE_POST = 'post image';

    protected $appends = ['ad_banner'];

    const HEADER = 1;

    const INDEX_TOP = 2;

    const INDEX_BOTTOM = 3;

    const POST_DETAILS = 4;

    const ALL_DETAILS_SIDE = 5;

    const CATEGORIES = 6;

    const ALL_DETAILS_TRENDING_POST = 7;

    const ALL_DETAILS_POPULAR_NEWS = 8;

    const INDEX_TRENDING_POST = 9;

    const INDEX_POPULAR_NEWS = 10;

    const INDEX_RECOMMENDED_POST = 11;

    const INDEX_TOP_THEME_1 = 12;

    const INDEX_BOTTOM_THEME_1 = 13;

    const POST_DETAILS_THEME_1 = 14;

    const ALL_DETAILS_SIDE_THEME_1 = 15;

    const ALL_DETAILS_POPULAR_NEWS_THEME_1 = 16;

    const CATEGORIES_THEME_1 = 17;

    const AD_SPACE = [
        self::HEADER => 'Header',
        self::INDEX_TOP => 'Index (Top)',
        self::INDEX_BOTTOM => 'Index (Bottom)',
        self::POST_DETAILS => 'Post Details',
        self::ALL_DETAILS_SIDE => 'Details Side',
        self::CATEGORIES => 'Categories',
        self::ALL_DETAILS_TRENDING_POST => 'Trending Post',
        self::ALL_DETAILS_POPULAR_NEWS => 'Popular News',
        self::INDEX_TRENDING_POST => 'Trending Post (Index Page)',
        self::INDEX_POPULAR_NEWS => 'Popular News (Index Page)',
        self::INDEX_RECOMMENDED_POST => 'Recommended Post (Index Page)',
        self::INDEX_TOP_THEME_1 => 'Index (Top Theme 1)',
        self::INDEX_BOTTOM_THEME_1 => 'Index (Bottom Theme 1)',
        self::POST_DETAILS_THEME_1 => 'Post Details (Theme 1)',
        self::ALL_DETAILS_SIDE_THEME_1 => 'Details Side (Theme 1)',
        self::ALL_DETAILS_POPULAR_NEWS_THEME_1 => 'Popular News (Theme 1)',
        self::CATEGORIES_THEME_1 => 'Categories (Theme 1)',
    ];

    const DESKTOP = 0;

    const MOBILE = 1;

    public function getAdBannerAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::IMAGE_POST)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }
        if ($this->ad_spaces == AdSpaces::HEADER) {
            return asset('images/1300.png');
        }
        if ($this->ad_view == AdSpaces::DESKTOP) {
            return asset('images/800.png');
        }
        if ($this->ad_view == AdSpaces::MOBILE) {
            return asset('images/350_290.png');
        }
    }
}
