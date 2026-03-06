<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class News extends Model
{
    use HasFactory;
    protected $guarded = [] ;
    protected $fallbackImage = 'maan/images/default_image.png';

    public function getImageAttribute($value)
    {
        $value = is_string($value) ? trim($value) : '';

        if ($value === '') {
            return json_encode([$this->resolvedFallbackImage()]);
        }

        // Legacy plain-path support: treat a single path the same as array JSON payloads.
        if (strpos($value, '[') !== 0 && strpos($value, '{') !== 0) {
            $decoded = [$value];
        } else {
            $decoded = json_decode($value, true);
        }

        if (!is_array($decoded)) {
            return json_encode([$this->resolvedFallbackImage()]);
        }

        $validImages = [];
        foreach ($decoded as $path) {
            if (!is_string($path) || trim($path) === '') {
                continue;
            }

            $normalizedPath = $this->normalizePublicImagePath($path);
            if ($normalizedPath !== null) {
                $validImages[] = $normalizedPath;
            }
        }

        if (count($validImages) === 0) {
            return json_encode([$this->resolvedFallbackImage()]);
        }

        return json_encode(array_values(array_unique($validImages)));
    }

    protected function normalizePublicImagePath(string $path): ?string
    {
        $path = trim($path);
        if ($path === '') {
            return null;
        }

        if (preg_match('/^https?:\/\//i', $path) === 1) {
            return $path;
        }

        $relativePath = ltrim(str_replace('\\', '/', $path), '/');
        if ($relativePath === '') {
            return null;
        }

        if (strpos($relativePath, 'public/') === 0) {
            $withoutPublic = substr($relativePath, 7);
            if ($withoutPublic !== '' && (
                File::exists(base_path($relativePath)) ||
                File::exists(public_path($withoutPublic))
            )) {
                return $relativePath;
            }

            return null;
        }

        $publicRelativePath = 'public/' . $relativePath;
        if (
            File::exists(base_path($publicRelativePath)) ||
            File::exists(public_path($relativePath))
        ) {
            return $publicRelativePath;
        }

        return null;
    }

    protected function resolvedFallbackImage(): string
    {
        $normalizedFallback = $this->normalizePublicImagePath($this->fallbackImage);
        return $normalizedFallback ?? $this->fallbackImage;
    }

    public function subCategories()
    {
        return $this->belongsTo(Newssubcategory::class,'subcategory_id');
    }

    public function comments()
    {
        return $this->hasMany(Newscomment::class,'news_id');
    }

    public function category()
    {
        return $this->hasOneThrough(Newscategory::class,Newssubcategory::class,'id','id','subcategory_id','category_id');
    }

}
