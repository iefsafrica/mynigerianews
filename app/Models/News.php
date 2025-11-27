<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class News extends Model
{
    use HasFactory;
    protected $guarded = [] ;

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
