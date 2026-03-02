<?php

//create function for breaking news

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use \App\Models\Theme;
use \App\Models\News;
use \App\Models\Photogallery;
use \App\Models\Newscategory;
use \App\Models\Settings;
use \App\Models\Seooptimization;
use App\Models\Socialshare;

function imageUpload($image, $imageDirectory, $existFileUrl=null,$name=null)
{
    if ($image)
    {
        if (file_exists($existFileUrl))
        {
            unlink($existFileUrl);
        }
        $fileName = $name.'.'.$image->getClientOriginalExtension();
        //$fileName = $image;
        $image->move($imageDirectory, $fileName);
        $fileUrl = $imageDirectory.$fileName;
    } else {
        if (isset($existFileUrl))
        {
            $fileUrl = $existFileUrl;
        } else {
            $fileUrl = '';
        }
    }
    return $fileUrl;
}
function breakingnews(){
    $breakingnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
        ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
        ->select('news.id','news.title','news.created_at','newscategories.name as news_category','newscategories.slug as news_categoryslug')
        ->where('news.breaking_news',1)
        ->where('news.status',1)
        ->latest()
        ->get();
    return $breakingnews;
}
function popularsnews(){
    $popularsnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
        ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
        ->join('users','news.reporter_id','=','users.id')
        ->select('news.id','news.title','news.image','news.date','newscategories.name as news_category','newscategories.slug as news_categoryslug',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
        ->where('news.status',1)
        ->orderByDesc('news.viewers')
        ->limit(3)
        ->get();
    return $popularsnews;
}
function newscategories(){
    if (! Schema::hasTable('newscategories')) {
        return collect();
    }

    $newscategories = Newscategory::where('type','news')
        ->orderBy('id')
        ->get();
    return $newscategories ;
}
function photogalleries(){
    $photogalleries = Photogallery::where('status',1)
        ->select('id','image')
        ->orderByDesc('id')
        ->limit(6)
        ->get();
    return $photogalleries ;
}
function settings(){
    $settings = Settings::first();
    return $settings;
}
function seooptimization(){
    $seooptimization = Seooptimization::first();
    return $seooptimization ;
}
function advertisement() {
    $advertisement = \App\Models\Advertisement::latest()->first();
    return $advertisement ;
}
function googleanalytics() {
    $googleanalytics = \App\Models\Googleanalytic::latest()->get();
    return $googleanalytics ;
}
function home() {
    $home = Newscategory::where('type','home')->value('name');
    return $home ;
}
function contactus() {
    $contactus = Newscategory::where('type','contact')->value('name');
    return $contactus ;
}
function socials(){
    $socials = Socialshare::take(5)->get();
    return $socials;
}
function headers(){
    $header = \App\Models\Header::where('status',1)->where('is_active',1)->first();
    return $header;
}
function menu(){
    $menu = \App\Models\Menu::where('status',1)->where('is_active',1)->first();
    return $menu;
}
function footer(){
    $footer = \App\Models\Footer::where('status',1)->where('is_active',1)->first();
    return $footer;
}
function companies(){
    $companies = \App\Models\Company::where('status',1)->first();
    return $companies;
}
function themeActivation(){
    if (Schema::hasTable('themes')) {
      $activeTheme = Theme::where('is_active',1)->first();
      return $activeTheme;
    }
}

