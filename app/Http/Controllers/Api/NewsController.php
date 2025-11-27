<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Api\News;
use App\Models\Newscategory;
use App\Traits\ApiResponse;
use App\Traits\ResponseMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    use ResponseMessage, ApiResponse;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /* breaking news */

    public function breakingNews(): JsonResponse
    {

        $breaking_news = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->select('news.id','news.title','news.created_at','newscategories.name as news_category','newscategories.slug as news_categoryslug')
            ->where('news.breaking_news',1)
            ->where('news.status',1)
            ->latest()
            ->paginate(5);
        return $this->successResponse($breaking_news, $this->load_success['message']);
    }

    /* news details */

    public function newsDetails($id): JsonResponse
    {
        $news = News::with('comments')->join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.summary', 'news.description', 'news.image', 'news.date', 'newssubcategories.name as news_subcategory', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('news.id', $id)
            ->where('news.status', 1)
            ->first();
        if ($news) {
            $news->increment('viewers');
            return $this->successResponse($news, $this->load_success['message']);
        } else {
            return $this->successResponse('', $this->not_found_message['message']);
        }
    }


    /* category news */

    public function categoryNews($id)
    {
        $news_category = Newscategory::find($id);
        if ($news_category) {
            $category_news = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
                ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
                ->join('users', 'news.reporter_id', '=', 'users.id')
                ->select('news.id', 'news.title', 'news.summary', 'news.description', 'news.image', 'news.date', 'newssubcategories.name as news_subcategory', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
                ->where('newscategories.id', $news_category->id)
                ->where('news.status', 1)
                ->orderByDesc('news.id')
                ->paginate(request('per_page',10));
            return $this->successResponse($category_news, $this->load_success['message']);
        } else {
            return $this->successResponse('', $this->not_found_message['message']);
        }
    }

    /* category popular news */

    public function categoryPopularNews($id)
    {
        $news_category = Newscategory::find($id);
        if ($news_category) {
            $popularallnews = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
                ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
                ->select('news.id', 'news.title', 'news.image', 'news.date', 'newscategories.slug as news_categoryslug')
                ->where('newscategories.id', $news_category->id)
                ->where('news.status', 1)
                ->orderByDesc('news.viewers')
                ->paginate(request('per_page',10));

            return $this->successResponse($popularallnews, $this->load_success['message']);
        } else {
            return $this->successResponse('', $this->not_found_message['message']);
        }
    }

    /* latest news */

    public function latestNews(): JsonResponse
    {
        $latest_news = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.image', 'news.date', 'news.created_at', 'newssubcategories.name as news_subcategory', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('news.status', 1)
            ->latest()
            ->paginate(request('per_page',10));
        return $this->successResponse($latest_news, $this->load_success['message']);
    }

    /* latest national news
     * */
    public function latestNewsNational(): JsonResponse
    {
        $latest_news_national = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.image', 'news.date', 'news.created_at', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('newscategories.name', 'National')
            ->where('news.status', 1)
            ->latest()
            ->paginate(request('per_page',10));
        return $this->successResponse($latest_news_national, $this->load_success['message']);
    }

    /* latest world news */

    public function latestNewsWorld(): JsonResponse
    {
        $latestnewsworld = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.image', 'news.date', 'news.created_at', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('newscategories.name', 'World')
            ->where('news.status', 1)
            ->latest()
            ->paginate(request('per_page',10));
        return $this->successResponse($latestnewsworld, $this->load_success['message']);
    }

    public function latestNewsPolitics(): JsonResponse
    {
        $latestnewspolitics = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.image', 'news.date', 'news.created_at', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('newscategories.name', 'Politics')
            ->where('news.status', 1)
            ->latest()
            ->paginate(request('per_page',10));
        return $this->successResponse($latestnewspolitics, $this->load_success['message']);
    }

    public function latestNewsLifeStyle(): JsonResponse
    {
        $latestnewslifestyle = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.image', 'news.date', 'news.created_at', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('newscategories.name', 'Lifestyle')
            ->where('news.status', 1)
            ->latest()
            ->paginate(request('per_page',10));
        return $this->successResponse($latestnewslifestyle, $this->load_success['message']);
    }

    public function latestNewsEntertainment(): JsonResponse
    {

        $latestnewsentertainment = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.image', 'news.date', 'news.created_at', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('newscategories.name', 'Entertainment')
            ->where('news.status', 1)
            ->latest()
            ->paginate(request('per_page',10));
        return $this->successResponse($latestnewsentertainment, $this->load_success['message']);
    }

    public function latestNewsSports(): JsonResponse
    {

        $latestnewssports = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.image', 'news.date', 'news.created_at', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('newscategories.name', 'Sports')
            ->where('news.status', 1)
            ->latest()
            ->paginate(request('per_page',10));
        return $this->successResponse($latestnewssports, $this->load_success['message']);
    }

    public function latestNewsTechnology(): JsonResponse
    {
        $latestnewstechnology = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.image', 'news.date', 'news.created_at', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('newscategories.name', 'Technology')
            ->where('news.status', 1)
            ->latest()
            ->paginate(request('per_page',10));
        return $this->successResponse($latestnewstechnology, $this->load_success['message']);
    }

    public function latestNewsBusiness(): JsonResponse
    {
        $latestnewsbusiness = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.image', 'news.date', 'news.created_at', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('newscategories.name', 'Business')
            ->where('news.status', 1)
            ->latest()
            ->paginate(request('per_page',10));
        return $this->successResponse($latestnewsbusiness, $this->load_success['message']);
    }

    /* popular news */

    public function popularNews(): JsonResponse
    {
        $popularsnews = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.image', 'news.date', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('news.status', 1)
            ->orderByDesc('news.viewers')
            ->paginate(request('per_page',10));
        return $this->successResponse($popularsnews, $this->load_success['message']);
    }

    public function popularNewsAll(): JsonResponse
    {
        $popularsnewsall = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.image', 'news.date', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('news.status', 1)
            ->orderByDesc('news.viewers')
            ->paginate(request('per_page',10));
        return $this->successResponse($popularsnewsall, $this->load_success['message']);
    }

    public function popularNewsWorld(): JsonResponse
    {
        $popularsnewsworld = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.image', 'news.date', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('newscategories.name', 'World')
            ->where('news.status', 1)
            ->orderByDesc('news.viewers')
            ->paginate(request('per_page',10));
        return $this->successResponse($popularsnewsworld, $this->load_success['message']);
    }

    public function popularNewsLifeStyle(): JsonResponse
    {
        $popularsnewslifestyle = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.image', 'news.date', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('newscategories.name', 'Lifestyle')
            ->where('news.status', 1)
            ->orderByDesc('news.viewers')
            ->paginate(request('per_page',10));
        return $this->successResponse($popularsnewslifestyle, $this->load_success['message']);
    }

    public function popularNewsEntertainment(): JsonResponse
    {
        $popularsnewsentertainment = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.image', 'news.date', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('newscategories.name', 'Entertainment')
            ->where('news.status', 1)
            ->orderByDesc('news.viewers')
            ->paginate(request('per_page',10));
        return $this->successResponse($popularsnewsentertainment, $this->load_success['message']);
    }

    public function popularNewsSports(): JsonResponse
    {
        $popularsnewssports = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.image', 'news.date', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('newscategories.name', 'Sports')
            ->where('news.status', 1)
            ->orderByDesc('news.viewers')
            ->paginate(request('per_page',10));
        return $this->successResponse($popularsnewssports, $this->load_success['message']);
    }

    public function popularNewsTechnology(): JsonResponse
    {
        $popularsnewstechnology = News::join('newssubcategories', 'news.subcategory_id', '=', 'newssubcategories.id')
            ->join('newscategories', 'newssubcategories.category_id', '=', 'newscategories.id')
            ->join('users', 'news.reporter_id', '=', 'users.id')
            ->select('news.id', 'news.title', 'news.image', 'news.date', 'newscategories.name as news_category', 'newscategories.slug as news_categoryslug', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('newscategories.name', 'Technology')
            ->where('news.status', 1)
            ->orderByDesc('news.viewers')
            ->paginate(request('per_page',10));
        return $this->successResponse($popularsnewstechnology, $this->load_success['message']);
    }

    public function newsSearch(Request $request): JsonResponse
    {
        $request->validate([
            'search' => 'required'
        ]);
        $searchnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->join('users','news.reporter_id','=','users.id')
            ->select('news.id','news.title','news.summary','news.description','news.image','news.date','newssubcategories.name as news_subcategory','newssubcategories.id as subcategory_id','newscategories.name as news_category','newscategories.id as category_id','newscategories.slug as news_categoryslug',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('title','LIKE', '%'. $request->search. '%')
            ->orWhere('summary','LIKE', '%'. $request->search. '%')
            ->orWhere('description','LIKE', '%'. $request->search. '%')
            ->orWhere('newscategories.name','LIKE', '%'. $request->search. '%')
            ->orWhere('newssubcategories.name','LIKE', '%'. $request->search. '%')
            ->where('news.status',1)
            ->orderByDesc('news.id')
            ->paginate(request('per_page',10));
        return $this->successResponse($searchnews, $this->load_success['message']);
    }
}
