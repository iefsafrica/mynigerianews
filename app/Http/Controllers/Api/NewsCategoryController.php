<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Api\Newscategory;
use App\Traits\ApiResponse;
use App\Traits\ResponseMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index():JsonResponse
    {
        $categories = Newscategory::select('id','name','slug','image')
            ->where('type','news')
            ->orderBy('name')
            ->paginate(request('per_page',10));
        return $this->successResponse($categories,$this->load_success['message']);
    }

    public function show($id) :JsonResponse
    {
        $NewsCategory = Newscategory::find($id);
        if($NewsCategory)
            return $this->successResponse($NewsCategory,$this->load_success['message']);
        else
            return $this->successResponse('',$this->not_found_message['message']);
    }
    public function subCategory(Request $request, $category_id):JsonResponse
    {
        $news_sub_category = \App\Models\Newssubcategory::where('category_id',$category_id)->paginate(request('per_page',10));
        if($news_sub_category)
            return $this->successResponse($news_sub_category,$this->load_success['message']);
        else
            return $this->successResponse('',$this->not_found_message['message']);
    }
}
