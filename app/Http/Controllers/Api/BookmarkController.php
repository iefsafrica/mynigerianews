<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Api\Bookmark;
use App\Traits\ApiResponse;
use App\Traits\ResponseMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookmarkController extends Controller
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
        $bookmarks = Bookmark::with('news')
            ->where('user_id', auth('api')->id())
            ->latest()
            ->paginate(request('per_page',10));
        return $this->successResponse($bookmarks, $this->load_success['message']);
    }

    public function store(Request $request) :JsonResponse
    {
        $request->validate([
            'news_id'=>'required'
        ]);
        try {
            $bookmark = Bookmark::where('news_id',$request->news_id)->where('user_id',auth('api')->id())->first();
            if(!$bookmark) {
                $bookmark = new Bookmark();
                $bookmark->news_id = $request->news_id;
                $bookmark->user_id = auth('api')->id();
                $bookmark->save();
            }
            if ($bookmark)
                return $this->successResponse($bookmark, $this->create_success_message['message']);
            else
                return $this->successResponse('', $this->create_fail_message['message']);
        }catch(Exception $exception){
            Log::error($exception->getMessage());
            return $this->errorResponse($this->create_fail_message['message']);
        }
    }

    public function destroy($id) :JsonResponse
    {
        try {
            $bookmark = Bookmark::find($id);
            if($bookmark) {
                $bookmark->delete();
                return $this->successResponse('', $this->delete_success_message['message']);
            }
            else
                return $this->successResponse('', $this->not_found_message['message']);
        }catch(Exception $exception){
            Log::error($exception->getMessage());
            return $this->errorResponse($this->delete_fail_message['message']);
        }
    }
}
