<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class News extends Model
{
    use HasFactory;
    protected $guarded = [] ;
    protected $fallbackImage = 'public/images/logo.png';

    public function getImageAttribute($value)
    {
        $value = is_string($value) ? trim($value) : '';

        // Legacy plain-path support: convert single path to JSON array format expected in views.
        if ($value !== '' && strpos($value, '[') !== 0 && strpos($value, '{') !== 0) {
            return json_encode([$value]);
        }

        $decoded = json_decode($value, true);
        if (!is_array($decoded)) {
            return json_encode([$this->fallbackImage]);
        }

        $validImages = array_values(array_filter($decoded, function ($path) {
            return is_string($path) && trim($path) !== '' && File::exists($path);
        }));

        if (count($validImages) === 0) {
            return json_encode([$this->fallbackImage]);
        }

        return json_encode($validImages);
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
