<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Photogallery;
use App\Traits\ApiResponse;
use App\Traits\ResponseMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotoGalleryController extends Controller
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

    public function latestPhotoGalleries(): JsonResponse
    {
        $latestphotogalleries = Photogallery::join('users', 'photogalleries.user_id', '=', 'users.id')
            ->select('photogalleries.id', 'photogalleries.title', 'photogalleries.image', 'photogalleries.created_at', DB::raw("CONCAT(users.first_name,' ',users.last_name) AS user_name"))
            ->where('status', 1)
            ->latest()
            ->paginate(request('per_page',10));
        return $this->successResponse($latestphotogalleries, $this->load_success['message']);
    }

    public function photoGallery($id): JsonResponse
    {
        $photogallery = Photogallery::join('users','photogalleries.user_id','=','users.id')
            ->select('photogalleries.id','photogalleries.title','photogalleries.description','photogalleries.image','photogalleries.created_at',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('photogalleries.id',$id)
            ->where('photogalleries.status',1)
            ->first();
        if($photogallery){
            $photogallery->increment('viewers');
            return $this->successResponse($photogallery, $this->load_success['message']);
        }else{
            return $this->successResponse('', $this->not_found_message['message']);
        }
    }
}
