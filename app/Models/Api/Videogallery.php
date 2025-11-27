<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Videogallery extends Model
{
    use HasFactory;

    public function getVideoAttribute()
    {
        if($this->attributes['video_source']!= 'Youtube')
            return URL::to('/'). '/' . $this->attributes['video'];
        else
            return $this->attributes['video'];
    }
}
