<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewsCategoryController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PhotoGalleryController;
use App\Http\Controllers\Api\VideoGalleryController;
use App\Http\Controllers\Api\NewsCommentsController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookmarkController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {

    Route::get('news_categories', [NewsCategoryController::class, 'index']);
    Route::get('news_sub_categories/{category_id}', [NewsCategoryController::class, 'subCategory'])->where('category_id', '[0-9]+');;

    Route::get('latest_news', [NewsController::class, 'latestNews']);
    Route::get('latest_news_national', [NewsController::class, 'latestNewsNational']);
    Route::get('latest_news_world', [NewsController::class, 'latestNewsWorld']);
    Route::get('latest_news_politics', [NewsController::class, 'latestNewsPolitics']);
    Route::get('latest_news_lifestyle', [NewsController::class, 'latestNewsLifeStyle']);
    Route::get('latest_news_entertainment', [NewsController::class, 'latestNewsEntertainment']);
    Route::get('latest_news_sports', [NewsController::class, 'latestNewsSports']);
    Route::get('latest_news_technology', [NewsController::class, 'latestNewsTechnology']);
    Route::get('latest_news_business', [NewsController::class, 'latestNewsBusiness']);

    Route::get('popular_news', [NewsController::class, 'popularNews']);
    Route::get('popular_news_all', [NewsController::class, 'popularNewsAll']);
    Route::get('popular_news_world', [NewsController::class, 'popularNewsWorld']);
    Route::get('popular_news_lifestyle', [NewsController::class, 'popularNewsLifeStyle']);
    Route::get('popular_news_entertainment', [NewsController::class, 'popularNewsEntertainment']);
    Route::get('popular_news_sports', [NewsController::class, 'popularNewsSports']);
    Route::get('popular_news_technology', [NewsController::class, 'popularNewsTechnology']);

    Route::get('latest_photo_galleries', [PhotoGalleryController::class, 'latestPhotoGalleries']);
    Route::get('photo_gallery_details/{id}', [PhotoGalleryController::class, 'photoGallery']);

    Route::get('video_galleries', [VideoGalleryController::class, 'index']);
    Route::get('video_galleries/{id}', [VideoGalleryController::class, 'show']);

    Route::get('breaking_news', [NewsController::class, 'breakingNews']);
    Route::post('search_news', [NewsController::class, 'newsSearch']);

    Route::get('category_news/{category_id}', [NewsController::class, 'categoryNews']);
    Route::get('category_popular_news/{category_id}', [NewsController::class, 'categoryPopularNews']);
    Route::get('news_details/{news_id}', [NewsController::class, 'newsDetails']);
    Route::get('news_comments/{news_id}', [NewsCommentsController::class, 'newsComments']);
    Route::post('news_comment', [NewsCommentsController::class, 'store']);
    Route::post('contact_us', [ContactUsController::class, 'store']);

    /** user Auth Routes */
    Route::post('user_register', [RegisterController::class, 'register']);
    Route::post('user_login', [LoginController::class, 'login']);
    Route::post('user_send_reset', [ForgotPasswordController::class, 'sendResetEmail']);
    Route::post('verify_password_reset_code', [ResetPasswordController::class, 'verifyCode']);
    Route::post('user_password_reset', [ResetPasswordController::class, 'reset']);

    Route::get('/login/{provider}', [AuthController::class,'redirectToProvider']);
    Route::post('/login/{provider}', [AuthController::class,'handleProviderCallback']);
});
Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function () {
    Route::get('user_logout', [LoginController::class, 'logout']);
    Route::post('update_profile', [AuthController::class,'updateProfile']);
    Route::post('change_password', [AuthController::class, 'changePassword']);

    Route::get('bookmarks', [BookmarkController::class, 'index']);
    Route::post('bookmarks', [BookmarkController::class,'store']);
    Route::delete('bookmarks/{id}', [BookmarkController::class,'destroy']);
});

