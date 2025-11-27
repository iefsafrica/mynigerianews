<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogsubcategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function blogcategory()
    {
        return $this->belongsTo(Blogcategory::class,'category_id');
    }
}
