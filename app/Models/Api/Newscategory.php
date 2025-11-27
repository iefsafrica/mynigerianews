<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Newscategory extends Model
{
    use HasFactory;
    protected $guarded=[];
public function getImageAttribute()
{

        return URL::to('/'). '/' . $this->attributes['image'];

}
}
