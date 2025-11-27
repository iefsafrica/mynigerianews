<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Newscategory;
use App\Models\Newsspeciality;
use App\Models\Newssubcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function maanNewsIndex()
    {
        $newsall = News::orderByDesc('id')->paginate(10);
        return view('admin.pages.news.news.index',compact('newsall'));
    }

    public function maanNewsCreate(Request $request)
    {
        if ($request->ajax()){
            $newssubcategory = Newssubcategory::where('category_id',$request->newscategory_id)->get();
            return response()->json($newssubcategory);
        }

        $newscategories     = Newscategory::where('type','news')->get();
        $newsspecialities   = Newsspeciality::all();
        $newsreporters      = User::where('user_type','0')->get();
        return view('admin.pages.news.news.create',compact('newscategories','newsspecialities','newsreporters'));
    }

    public function maanNewsStore(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'summary'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'date'=>'required',
            'tags'=>'required',
            'speciality_id'=>'required',
            'reporter_id'=>'required',
            'meta_keyword'=>'required',
            'meta_description'=>'required',
        ]);


        if ($request->hasFile('image')){
            $request->validate([
                'image.*'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:200',
            ]);
            foreach ($request->file('image') as $image) {
                $news_imagename         = $image->getClientOriginalName();
                $news_image             = 'maannewsimage' . date('dmY_His') . '_' . $news_imagename;
                $news_image_url[]       = 'public/uploads/images/newsimages/' . $news_image;
                $news_destinationPath   = base_path() . '/public/uploads/images/newsimages/';
                $news_success           = $image->move($news_destinationPath, $news_image);
            }
            if ($news_success){
                $news_image_urls = $news_image_url ;

            }
        }else{
            $news_image_urls = '' ;
        }

        $data['title']          = $request->title;
        $data['summary']        = trim($request->summary);
        $data['description']    = trim($request->description);
        $data['subcategory_id'] = $request->subcategory_id;
        $data['date']           = date('Y-m-d', strtotime($request->date));
        $data['tags']           = $request->tags;
        $data['speciality_id']  = $request->speciality_id;
        $data['reporter_id']    = $request->reporter_id;
        $data['meta_keyword']    = $request->meta_keyword;
        $data['meta_description']    = $request->meta_description;
        if($request->status){
            $data['status']     = 1 ;
        }else{
            $data['status']     = 0 ;
        }
        if($request->breaking_news){
            $data['breaking_news'] = 1 ;
        }else{
            $data['breaking_news'] = 0 ;
        }
        $data['image']          = json_encode($news_image_urls);
        $data['user_id']        = Auth::user()->id;
        News::create($data);

        //post count
        $postcount                  = Newscategory::where('id',$request->category_id)->value('post_counter');
        $datapost['post_counter']   = $postcount + 1;
        Newscategory::where('id',$request->category_id)->update($datapost);
        //session message
        $this->setSuccess('Inserted');
        //redirect route
        return redirect()->route('admin.news') ;
    }

    public function maanNewsEdit(Request $request,News $news)
    {
        $newscategories         = Newscategory::where('type','news')->get();
        $newsspecialities       = Newsspeciality::all();
        $newsreporters          = User::where('user_type','0')->get();
        $newscategoryid         = Newssubcategory::where('id',$news->subcategory_id)->value('category_id');
        $newssubcategories      = Newssubcategory::where('category_id',$newscategoryid)->get();
        if ($request->ajax()){
            $newssubcategory    = Newssubcategory::where('category_id',$request->newscategory_id)->get();
            return response()->json($newssubcategory);
        }
        return view('admin.pages.news.news.edit',compact('news','newscategories','newsspecialities','newsreporters','newscategoryid','newssubcategories'));
    }

    public function maanNewsUpdate(Request $request, News $news)
    {
     $request->validate([
         'title'=>'required',
         'summary'=>'required',
         'description'=>'required',
         'category_id'=>'required',
         'subcategory_id'=>'required',
         'date'=>'required',
         'tags'=>'required',
         'speciality_id'=>'required',
         'reporter_id'=>'required',
         'meta_keyword'=>'required',
         'meta_description'=>'required',
     ]);
     if ($request->hasFile('image')){
         $request->validate([
             'image.*'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:200',
         ]);
         $getimages = json_decode($news->image);
         if ($getimages){
             foreach ($getimages as $image){
                 if (File::exists($image)){
                     unlink($image);
                 }
             }
         }
         foreach ($request->file('image') as $image) {
             $news_imagename        = $image->getClientOriginalName();
             $news_image            = 'maannewsimage' . date('dmY_His') . '_' . $news_imagename;
             $news_image_url[]      = 'public/uploads/images/newsimages/' . $news_image;
             $news_destinationPath  = base_path() . '/public/uploads/images/newsimages/';
             $news_success          = $image->move($news_destinationPath, $news_image);
         }
         if ($news_success){
             $news_image_urls = json_encode($news_image_url); ;

         }
     }else{
         $news_image_urls = $news->image ;
     }
        $data['title']              = $request->title;
        $data['summary']            = trim($request->summary);
        $data['description']        = trim($request->description);
        $data['subcategory_id']     = $request->subcategory_id;
        $data['date']               = date('Y-m-d', strtotime($request->date));
        $data['tags']               = $request->tags;
        $data['speciality_id']      = $request->speciality_id;
        $data['reporter_id']        = $request->reporter_id;
        $data['meta_keyword']       = $request->meta_keyword;
        $data['meta_description']   = $request->meta_description;
        if($request->status){
            $data['status']         = 1 ;
        }else{
            $data['status']           = 0 ;
        }
        if($request->breaking_news){
            $data['breaking_news'] = 1 ;
        }else{
            $data['breaking_news'] = 0 ;
        }
        $data['image']          = $news_image_urls;
        $data['user_id']        = Auth::user()->id;
        News::where('id',$news->id)->update($data);
        //session message
        $this->setSuccess('Updated');
        //redirect route
        return redirect()->route('admin.news') ;
    }

    public function maanNewsDestroy(News $news)
    {
        $images = json_decode($news->image);

        foreach ($images as $image){
            if (File::exists($image)){
                unlink($image);
            }
        }

        $news->delete();
        //post count
        $postcount = Newssubcategory::join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->where('newssubcategories.id',$news->subcategory_id)
            ->select('newscategories.id','newscategories.post_counter')
            ->first();
        if ($postcount->post_counter==0){
            $datapost['post_counter']= 0;
        }else{
            $datapost['post_counter']= $postcount->post_counter - 1;
        }

        Newscategory::where('id',$postcount->id)->update($datapost);
        return redirect()->route('admin.news');
    }
}
