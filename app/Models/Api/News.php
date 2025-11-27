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

    public function comments(){
        return $this->hasMany(Newscomment::class)->orderBy('created_at', 'desc')->limit(15);
    }

    public function getImageAttribute(): array
    {
        $images = [];
        foreach(json_decode($this->attributes['image']) as $key => $image)
        {
            array_push($images,URL::to('/'). '/' . $image);
        }
        return $images;
    }
}
