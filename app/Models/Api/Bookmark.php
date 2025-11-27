<?php

namespace App\Models\Api;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = ['user_id','news_id'];

    public function news(){
        return $this->belongsTo(News::class);
    }
    public function user(){
        return $this->hasOne(User::class);
    }

}
