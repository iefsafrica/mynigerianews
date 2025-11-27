<?php

use App\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NationalController;
use App\Http\Controllers\Frontend\WorldController;
use App\Http\Controllers\Frontend\TechnologyController;
use App\Http\Controllers\Frontend\PoliticsController;
use App\Http\Controllers\Frontend\LifestyleController;
use App\Http\Controllers\Frontend\BusinessController;
use App\Http\Controllers\Frontend\EntertainmentController;
use App\Http\Controllers\Frontend\SportController;
use App\Http\Controllers\Frontend\SignupController;
use App\Http\Controllers\Frontend\SigninController;
use App\Http\Controllers\Maan\MaanuserController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\NewscategoryController;
use App\Http\Controllers\Admin\NewssubcategoryController;
use App\Http\Controllers\Admin\NewsspecialityController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogcategoryController;
use App\Http\Controllers\Admin\BlogsubcategoryController;
use App\Http\Controllers\Admin\NewsreporterController;
use App\Http\Controllers\Admin\PhotogalleryController;
use App\Http\Controllers\Admin\VideogalleryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\FooterController;
use Illuminate\Support\Facades\Artisan;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[HomeController::class,'maanIndex'])->name('home');
Route::get('/home-one',[HomeController::class,'maanIndex'])->name('home-one');
Route::get('/home-two',[HomeController::class,'maanIndex'])->name('home-two');
Route::get('/subscribe/ajax',[HomeController::class,'subscribeAjax'])->name('subscribe');
//route search
Route::get('/search',[SearchController::class,'maanSearch'])->name('search');

foreach (newscategories() as $newscategory){
    Route::get($newscategory->slug.'/{newscategory?}',[\App\Http\Controllers\Frontend\NewsController::class,'maanNews'])->name($newscategory->slug);
    Route::get($newscategory->slug.'/details/{id}/{slug?}',[\App\Http\Controllers\Frontend\NewsController::class,'maanNewsDetails'])->name($newscategory->slug.'.details');
}

Route::get('/photogallery',[\App\Http\Controllers\Frontend\PhotogalleryController::class,'maanPhotogalleryIndex'])->name('photogallery');
Route::get('/photogallery/details/{id}/{slug?}',[\App\Http\Controllers\Frontend\PhotogalleryController::class,'maanPhotogalleryDetails'])->name('photogallery.details');

// route news comments
Route::post('news/comment/{id?}',[\App\Http\Controllers\Frontend\NewsController::class,'maanNewsComment'])->name('news.comment');
// route contact us
Route::get('/contactus',[\App\Http\Controllers\Frontend\ContactusController::class,'maanNewsContactus'])->name('contactus');
Route::post('/contactus',[\App\Http\Controllers\Frontend\ContactusController::class,'maanNewsContactusStore'])->name('contactus.store');

//route signup
Route::get('/signup',[SignupController::class,'maanSignupIndex'])->name('signup');
Route::post('/signup',[SignupController::class,'maanSignupStore']);

//route signin
Route::get('/signin',[SigninController::class,'maanSigninIndex'])->name('signin');
Route::post('/signin',[SigninController::class,'maanSigninLogin']);
Route::get('/signout',[SigninController::class, 'maanSignout'])->name('signout');
// Route login
Route::get('/login',[AuthController::class,'maanIndex'])->name('login');
Route::post('/login',[AuthController::class,'maanLogin']);
Route::get('/logout',[AuthController::class,'maanLogout'])->name('logout');

// Route admin all
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function (){
    Route::get('/',[AdminController::class,'maanDashboard'])->name('dashboard');
    Route::group(['middleware'=>['role:super-admin']],function (){

        //Route role
        Route::get('roles',[RoleController::class, 'maanRoleIndex'])->name('role');
        Route::post('roles',[RoleController::class, 'maanRoleStore']);
        Route::get('roles/edit/{id}',[RoleController::class,'maanRoleEdit'])->name('role.edit');
        Route::match(['put', 'patch'],'role/update/{id}',[RoleController::class,'maanRoleUpdate'])->name('role.update');
        Route::delete('roles/destroy/{id}',[RoleController::class,'maanRoleDestroy'])->name('role.destroy');

    });

    Route::group(['middleware'=>['role:super-admin,admin,editor']],function (){

        //Route user
        Route::get('/user',[UserController::class,'maanUserIndex'])->name('user');
        //Route user create
        Route::get('/user/create',[UserController::class,'maanUserCreate'])->name('user.create');
        //Route user store
        Route::post('/user',[UserController::class,'maanUserStore']);
        //Route user edit
        Route::get('/user/edit/{user}',[UserController::class,'maanUserEdit'])->name('user.edit');
        //Route user update
        Route::match(['put', 'patch'],'/user/update/{user}',[UserController::class,'maanUserUpdate'])->name('user.update');
        //user ajax route
        Route::get('/user/ajax', [UserController::class, 'maanUserAjax'])->name('user.ajax');

        //Route user destroy
        Route::delete('/user/destroy/{user}',[UserController::class,'maanUserDestroy'])->name('user.destroy');

        //Route settings
        Route::get('/settings',[SettingsController::class,'maanSettingsIndex'])->name('settings.index');
        Route::post('/settings',[SettingsController::class,'maanSettingsStore'])->name('settings.store');
        Route::match(['put', 'patch'],'/settings/update/{settings}',[SettingsController::class,'maanSettingsUpdate'])->name('settings.update');
        Route::delete('/settings/destroy/{settings}',[SettingsController::class,'maanSettingsDestroy'])->name('settings.destroy');
        //Route company..
        Route::get('/company',[CompanyController::class,'maanCompanyIndex'])->name('company.index');
        Route::post('/company',[CompanyController::class,'maanCompanyStore'])->name('company.store');
        Route::match(['put', 'patch'],'/company/update/{company}',[CompanyController::class,'maanCompanyUpdate'])->name('company.update');
        Route::delete('/company/destroy/{company}',[CompanyController::class,'maanCompanyDestroy'])->name('company.destroy');
        // Route theme settings
        Route::prefix('theme')->name('theme.')->controller(ThemeController::class)->group(function () {
            Route::get('/','maanThemeIndex')->name('index');
            Route::post('/','maanThemeStore')->name('store');
            Route::put('/update/{theme}','maanThemeUpdate')->name('update');
            Route::delete('destroy/{theme}','maanThemeDestroy')->name('destroy');
            Route::get('/color','maanThemeColor')->name('color');
        });
        // Route seo
        Route::prefix('seo')->name('seo.')->group(function (){
            Route::get('/',[\App\Http\Controllers\Admin\SeooptimizationController::class,'maanSeooptimzationIndex'])->name('index');
            Route::post('/',[\App\Http\Controllers\Admin\SeooptimizationController::class,'maanSeooptimzationStore'])->name('store');
            Route::match(['put', 'patch'],'/update/{seooptimization}',[\App\Http\Controllers\Admin\SeooptimizationController::class,'maanSeooptimzationUpdate'])->name('update');
            Route::get('/sitemap',[\App\Http\Controllers\Admin\SeooptimizationController::class,'maanSeooptimzationSitemape'])->name('sitemap');
        });
        Route::prefix('ads')->name('ads.')->group(function (){
            Route::get('/',[\App\Http\Controllers\Admin\AdvertisementController::class,'maanAdvertisementIndex'])->name('index');
            Route::post('/',[\App\Http\Controllers\Admin\AdvertisementController::class,'maanAdvertisementStore'])->name('store');
            Route::match(['put', 'patch'],'/update/{advertisement}',[\App\Http\Controllers\Admin\AdvertisementController::class,'maanAdvertisementUpdate'])->name('update');
            Route::delete('/destroy/{advertisement}',[\App\Http\Controllers\Admin\AdvertisementController::class,'maanAdvertisementDestroy'])->name('destroy');
            Route::post('/googleanalytics',[\App\Http\Controllers\Admin\AdvertisementController::class,'maanAdvertisementGoogleAnalyticsStore'])->name('googleanalytics.store');
            Route::match(['put', 'patch'],'/googleanalytics/update/{googleanalytic}',[\App\Http\Controllers\Admin\AdvertisementController::class,'maanAdvertisementGoogleAnalyticsUpdate'])->name('googleanalytics.update');
            //Route news category delete
            Route::delete('/googleanalytics/destroy/{googleanalytic}',[\App\Http\Controllers\Admin\AdvertisementController::class,'maanAdvertisementGoogleAnalyticsDestroy'])->name('googleanalytics.destroy');

        });
        Route::prefix('social')->name('social.')->group(function () {
            Route::get('/',[\App\Http\Controllers\Admin\SocialshareController::class,'maanSocialIndex'])->name('index');
            Route::post('/',[\App\Http\Controllers\Admin\SocialshareController::class,'maanSocialStore'])->name('store');
            Route::match(['put', 'patch'],'/update/{socialshare}',[\App\Http\Controllers\Admin\SocialshareController::class,'maanSocialUpdate'])->name('update');
            Route::delete('/destroy/{socialshare}',[\App\Http\Controllers\Admin\SocialshareController::class,'maanSocialDestroy'])->name('destroy');
        });
        // Route Header
        Route::prefix('header')->name('header.')->group(function () {
            Route::get('/',[HeaderController::class,'maanHeaderIndex'])->name('index');
            Route::get('/create',[HeaderController::class,'maanHeaderCreate'])->name('create');
            Route::post('/store',[HeaderController::class,'maanHeaderStore'])->name('store');
            Route::get('/edit/{id}',[HeaderController::class,'maanHeaderEdit'])->name('edit');
            Route::post('/update/{id}',[HeaderController::class,'maanHeaderUpdate'])->name('update');
            Route::delete('/destroy/{id}',[HeaderController::class,'maanHeaderDestroy'])->name('destroy');
        });
        // Route Footer
        Route::prefix('footer')->name('footer.')->group(function () {
            Route::get('/',[FooterController::class,'maanFooterIndex'])->name('index');
            Route::get('/create',[FooterController::class,'maanFooterCreate'])->name('create');
            Route::post('/store',[FooterController::class,'maanFooterStore'])->name('store');
            Route::get('/edit/{id}',[FooterController::class,'maanFooterEdit'])->name('edit');
            Route::post('/update/{id}',[FooterController::class,'maanFooterUpdate'])->name('update');
            Route::delete('/destroy/{id}',[FooterController::class,'maanFooterDestroy'])->name('destroy');
        });
        Route::get('/subscriber',[\App\Http\Controllers\Admin\SubscriberController::class,'index'])->name('subscriber');
        Route::delete('/subscriber/destroy/{id}',[\App\Http\Controllers\Admin\SubscriberController::class,'destroy'])->name('subscriber.destroy');

    });
    Route::group(['middleware'=>['role:super-admin,admin,editor,reporter']],function(){

        //Route news category
        Route::get('/news/category',[NewscategoryController::class,'maanNewsCategoryIndex'])->name('news.category');
        //Route news category store
        Route::post('/news/category',[NewscategoryController::class,'maanNewsCategoryStore']);
        //Route news category update
        Route::match(['put', 'patch'],'/news/category/update/{newscategory}',[NewscategoryController::class,'maanNewsCategoryUpdate'])->name('news.category.update');
        //Route news category delete
        Route::delete('/news/category/destroy/{newscategory}',[NewscategoryController::class,'maanNewsCategoryDestroy'])->name('news.category.destroy');
        //Route news sub-category
        Route::get('/news/subcategory',[NewssubcategoryController::class,'maanNewsSubcategoryIndex'])->name('news.subcategory');
        //Route news sub-category store
        Route::post('/news/subcategory',[NewssubcategoryController::class,'maanNewsSubcategoryStore']);
        //Route news sub-category update
        Route::match(['put', 'patch'],'/news/subcategory/update/{newssubcategory}',[NewssubcategoryController::class,'maanNewsSubcategoryUpdate'])->name('news.subcategory.update');
        //Route news sub-category delete
        Route::delete('/news/subcategory/destroy/{newssubcategory}',[NewssubcategoryController::class,'maanNewsSubcategoryDestroy'])->name('news.subcategory.destroy');
        //Route news speciality
        Route::get('/news/speciality',[NewsspecialityController::class,'maanNewsSpecialityIndex'])->name('news.speciality');
        //Route news speciality update
        Route::match(['put', 'patch'],'/news/speciality/update/{newsspeciality}',[NewsspecialityController::class,'maanNewsSpecialityUpdate'])->name('news.speciality.update');

        //Route news
        Route::get('/news',[NewsController::class,'maanNewsIndex'])->name('news');
        //Route news create
        Route::get('/news/create',[NewsController::class,'maanNewsCreate'])->name('news.create');
        //Route news store
        Route::post('/news',[NewsController::class,'maanNewsStore']);
        //Route news edit
        Route::get('/news/edit/{news?}',[NewsController::class,'maanNewsEdit'])->name('news.edit');
        //Route news update
        Route::match(['put','patch'],'/news/update/{news}',[NewsController::class,'maanNewsUpdate'])->name('news.update');
        //Route news delete
        Route::delete('/news/destroy/{news}',[NewsController::class,'maanNewsDestroy'])->name('news.destroy');
        //Route photogallery
        Route::get('/photogallery',[PhotogalleryController::class,'maanPhotogalleryIndex'])->name('photogallery');
        //Route photogallery store
        Route::post('/photogallery',[PhotogalleryController::class,'maanPhotogalleryStore']);
        //Route photogallery edit
        Route::get('/photogallery/edit/{photogallery}',[PhotogalleryController::class,'maanPhotogalleryEdit'])->name('photogallery.edit');
        //Route photogallery update
        Route::match(['put', 'patch'],'/photogallery/update/{photogallery}',[PhotogalleryController::class,'maanPhotogalleryUpdate'])->name('photogallery.update');
        //Route photogallery delete
        Route::delete('/photogallery/destroy/{photogallery}',[PhotogalleryController::class,'maanPhotogalleryDestroy'])->name('photogallery.destroy');
        //Route videogallery
        Route::get('/videogallery',[VideogalleryController::class,'maanVideogalleryIndex'])->name('videogallery');
        //Route videogallery create
        Route::get('/videogallery/create',[VideogalleryController::class,'maanVideogalleryCreate'])->name('videogallery.create');
        //Route videogallery store
        Route::post('/videogallery',[VideogalleryController::class,'maanVideogalleryStore']);
        //Route videogallery edit
        Route::get('/videogallery/edit/{videogallery}',[VideogalleryController::class,'maanVideogalleryEdit'])->name('videogallery.edit');
        //Route videogallery update
        Route::match(['put', 'patch'],'/videogallery/update/{videogallery}',[VideogalleryController::class,'maanVideogalleryUpdate'])->name('videogallery.update');
        //Route videogallery delete
        Route::delete('/videogallery/destroy/{videogallery}',[VideogalleryController::class,'maanVideogalleryDestroy'])->name('videogallery.destroy');

    });

    Route::group(['middleware'=>['role:super-admin,admin,editor,reporter,accountent']],function (){

//Route blog category
        Route::get('/blog/category',[BlogcategoryController::class,'maanBlogCategoryIndex'])->name('blog.category');
        //Route blog category store
        Route::post('/blog/category',[BlogcategoryController::class,'maanBlogCategoryStore']);
        //Route blog category update
        Route::match(['put', 'patch'],'/blog/category/update/{blogcategory}',[BlogcategoryController::class,'maanBlogCategoryUpdate'])->name('blog.category.update');
        //Route blog category delete
        Route::delete('/blog/category/destroy/{blogcategory}',[BlogcategoryController::class,'maanBlogCategoryDestroy'])->name('blog.category.destroy');
        //Route blog sub-category
        Route::get('/blog/subcategory',[BlogsubcategoryController::class,'maanBlogSubcategoryIndex'])->name('blog.subcategory');
        //Route blog sub-category store
        Route::post('/blog/subcategory',[BlogsubcategoryController::class,'maanBlogSubcategoryStore']);
        //Route blog sub-category update
        Route::match(['put', 'patch'],'/blog/subcategory/update/{blogsubcategory}',[BlogsubcategoryController::class,'maanBlogSubcategoryUpdate'])->name('blog.subcategory.update');
        Route::delete('/blog/subcategory/destroy/{blogsubcategory}',[BlogsubcategoryController::class,'maanBlogSubcategoryDestroy'])->name('blog.subcategory.destroy');
        //Route blog
        Route::get('/blog',[BlogController::class,'maanBlogIndex'])->name('blog');
        //Route blog create
        Route::get('/blog/create',[BlogController::class,'maanBlogCreate'])->name('blog.create');
        //Route blog store
        Route::post('/blog',[BlogController::class,'maanBlogStore']);
        //Route blog edit
        Route::get('/blog/edit/{blog?}',[BlogController::class,'maanBlogEdit'])->name('blog.edit');
        //Route blog update
        Route::match(['put','patch'],'/blog/update/{blog}',[BlogController::class,'maanBlogUpdate'])->name('blog.update');
        //Route blog delete
        Route::delete('/blog/destroy/{blog}',[BlogController::class,'maanBlogDestroy'])->name('blog.destroy');

        //Route reporter
        Route::get('/reporter',[NewsreporterController::class,'maanReporterIndex'])->name('reporter');
        //Route reporter create
        Route::get('/reporter/create',[NewsreporterController::class,'maanReporterCreate'])->name('reporter.create');
        //Route reporter store
        Route::post('/reporter',[NewsreporterController::class,'maanReporterStore']);
        //Route reporter edit
        Route::get('/reporter/edit/{reporter}',[NewsreporterController::class,'maanReporterEdit'])->name('reporter.edit');
        //Route reporter update
        Route::match(['put', 'patch'],'/reporter/update/{reporter}',[NewsreporterController::class,'maanReporterUpdate'])->name('reporter.update');
        //Route reporter delete
        Route::delete('/reporter/destroy/{reporter}',[NewsreporterController::class,'maanReporterDestroy'])->name('reporter.destroy');
        //Route contact
        Route::get('contact',[\App\Http\Controllers\Admin\ContactController::class,'maancontact'])->name('contact');
        //Route contact delete
        Route::delete('contact/destroy/{id}',[\App\Http\Controllers\Admin\ContactController::class,'maancontactdestroy'])->name('contact.destroy');
    });

    //Route blog status publish
    Route::get('/publish/status/ajax',[AjaxController::class,'maanPublishStatus'])->name('publish.status.ajax');
    //route theme color change
    Route::get('/publish/theme-color/ajax',[AjaxController::class,'maanPublishThemeColor'])->name('publish.theme-color.ajax');
});
//route maan user
Route::prefix('maanuser')->name('maanuser.')->group(function (){

    Route::get('/',[MaanuserController::class,'index'])->name('index')->middleware('auth:maanuser');
    Route::get('/reporter',[MaanuserController::class,'maanUserReporter'])->name('reporter')->middleware('auth:maanuser');
    Route::get('/post',[MaanuserController::class,'maanUserPost'])->name('post')->middleware('auth:maanuser');
});
Route::get('/sitemap',function (){
    $site = App::make('sitemap');
    //$site->add(URL::to('/'), date("Y-m-d h:i:s"),1,'daily');

    $latestnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
        ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
        ->select('news.id','news.title','news.date','news.created_at','newscategories.name as news_category','newscategories.slug')
        ->latest()
        ->get();
    foreach ($latestnews as $news){
        $site->add(URL::to(strtolower($news->news_category)), $news->created_at,1.0,'daily');
    }

    $site->store('xml','sitemap');
    return response ()->view ('sitemap.sitemap', [
        'latestnewses' => $latestnews,
    ])/*->header ('Content-Type', 'text/xml')*/;


});
/* clear all cache */
Route::get('/clear-all', function () {
    Artisan::call('optimize:clear');
    echo Artisan::output();
});
/* clear view cache */
Route::get('/clear-view-cache', function () {
    Artisan::call('view:clear');
    return 'View Cache Cleared';
});
Route::get('/migrate',function(){
    Artisan::call('migrate');
    echo Artisan::output();
});

