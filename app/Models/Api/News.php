<?php

namespace App\Models\Api;

use App\Models\Newscomment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class News extends Model
{
    use HasFactory;
    protected $guarded = [] ;
    protected $fallbackImage = 'maan/images/default_image.png';

    public function comments(){
        return $this->hasMany(Newscomment::class)->orderBy('created_at', 'desc')->limit(15);
    }

    public function getImageAttribute(): array
    {
        $images = [];
        $rawImages = json_decode((string) ($this->attributes['image'] ?? ''), true);
        if (!is_array($rawImages)) {
            return [$this->fallbackImageUrl()];
        }

        foreach ($rawImages as $image) {
            $path = is_string($image) ? trim(str_replace('\\', '/', $image)) : '';
            if ($path === '') {
                continue;
            }

            if (preg_match('/^https?:\/\//i', $path) === 1) {
                $images[] = $path;
                continue;
            }

            $images[] = URL::to('/') . '/' . publicAssetPath($path);
        }

        return count($images) > 0 ? array_values(array_unique($images)) : [$this->fallbackImageUrl()];
    }

    protected function fallbackImageUrl(): string
    {
        return URL::to('/') . '/' . publicAssetPath($this->fallbackImage);
    }
}
