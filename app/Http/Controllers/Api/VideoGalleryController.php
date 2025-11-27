<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Api\Videogallery;
use App\Traits\ApiResponse;
use App\Traits\ResponseMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoGalleryController extends Controller
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

    public function index(): JsonResponse
    {
        $videogalleries = Videogallery::join('users', 'videogalleries.user_id', '=', 'users.id')
            ->select('videogalleries.id', 'videogalleries.title', 'videogalleries.video', 'videogalleries.video_source', 'videogalleries.created_at', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('status', 1)
            ->latest()
            ->paginate(request('per_page',10));
        return $this->successResponse($videogalleries, $this->load_success['message']);
    }

    public function show($id): JsonResponse
    {
        $videogallery = Videogallery::join('users','videogalleries.user_id','=','users.id')
            ->select('videogalleries.id','videogalleries.title','videogalleries.description','videogalleries.video','videogalleries.video_source','videogalleries.created_at',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('videogalleries.id',$id)
            ->where('videogalleries.status',1)
            ->first();
        if($videogallery){
            return $this->successResponse($videogallery, $this->load_success['message']);
        }else{
            return $this->successResponse('', $this->not_found_message['message']);
        }
    }
}
