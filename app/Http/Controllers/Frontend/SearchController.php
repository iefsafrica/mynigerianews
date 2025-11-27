<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function maanSearch(Request $request)
    {

        $searchnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->join('users','news.reporter_id','=','users.id')
            ->select('news.id','news.title','news.summary','news.description','news.image','news.date','newssubcategories.name as news_subcategory','newscategories.name as news_category','newscategories.slug as news_categoryslug',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('title','LIKE', '%'. $request->search. '%')
            ->orWhere('summary','LIKE', '%'. $request->search. '%')
            ->orWhere('description','LIKE', '%'. $request->search. '%')
            ->where('news.status',1)
            ->orderByDesc('news.id')
            ->paginate(10);
        $popularsnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->select('news.id','news.title','news.image','news.date','newscategories.name as news_category','newscategories.slug as news_categoryslug')
            ->where('news.status',1)
            ->orderByDesc('news.viewers')
            ->limit(4)
            ->get();
        $recentnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->select('news.id','news.title','news.image','news.date','newscategories.name as news_category','newscategories.slug as news_categoryslug')
            ->where('news.status',1)
            ->orderByDesc('news.id')
            ->limit(5)
            ->get();
        return view('frontend.pages.search',compact('searchnews','popularsnews','recentnews'));
    }
}
