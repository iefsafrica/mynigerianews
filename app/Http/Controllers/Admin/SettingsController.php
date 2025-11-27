<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    public function maanSettingsIndex(){

        $settings = Settings::all();
        return view('admin.pages.settings.application.index',compact('settings'));
    }
    public function maanSettingsStore(Request $request){
        //title ,name, short name validation..
        if ($request->title||$request->name||$request->short_name){
            $request->validate([
                'title'=> 'required',
                'name'=> 'required',
                'short_name'=> 'required',
            ]);
        }
        //favicon validation..
        if ($request->favicon!=''){
            $request->validate([
                'favicon'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:100|dimensions:max_width=50,max_height=50',
            ],[

                'favicon.dimensions'    => 'Required favicon maximum 50x50 image',
                'favicon.max'  => 'image size should not be more than 100 kB'
            ]);

        }
        //icon validation..
        if ($request->icon!=''){
            $request->validate([
                'icon'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500|dimensions:max_width=100,max_height=80',
            ],[
                'icon.dimensions'    => 'Required icon maximum 100x80 image',
                'icon.max'  => 'image size should not be more than 500 kB'
            ]);
        }
        //logo validation..
        if ($request->logo!=''){
            $request->validate([
                'logo'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024|dimensions:max_width=200,max_height=200',
            ],[
                'logo.dimensions'    => 'Required logo maximum 200x200 image',
                'logo.max'  => 'image size should not be more than 1024 kB'
            ]);
        }
        //logo footer validation..
        if ($request->logo_footer!=''){
            $request->validate([
                'logo_footer'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024|dimensions:max_width=200,max_height=200',
            ],[
                'logo_footer.dimensions'    => 'Required logo footer maximum 200x200 image',
                'logo_footer.max'  => 'image size should not be more than 1024 kB'
            ]);
        }
        // favicon..
        if (Settings::exists()){
            $settings = Settings::first() ;
        }else{
            $settings = new Settings();
        }

        // favicon..
        if ($request->hasFile('favicon')){

            if ($request->favicon!=''){

                if (File::exists($settings->favicon)){
                    unlink($settings->favicon);
                }

                $favicon            = 'favicon.'.$request->favicon->getClientOriginalExtension();

                // image path
                $favicon_url          = 'public/uploads/images/logo/' . $favicon;
                //image base path
                $destinationPath    = base_path() . '/public/uploads/images/logo/';
                $success            = $request->favicon->move($destinationPath, $favicon);
                if ($success){
                    $favicon_urls     = $favicon_url ;
                }
            }else{
                $favicon_urls         = '' ;
            }
        }
        //icon..
        if ($request->hasFile('icon')){
            if ($request->icon!=''){

                if (File::exists($settings->icon)){
                    unlink($settings->icon);
                }

                $icon            = 'icon.'.$request->icon->getClientOriginalExtension();

                // icon path
                $icon_url          = 'public/uploads/images/logo/' . $icon;
                //icon base path
                $destinationPath    = base_path() . '/public/uploads/images/logo/';
                $success            = $request->icon->move($destinationPath, $icon);
                if ($success){
                    $icon_urls     = $icon_url ;
                }
            }else{
                $icon_urls         = '' ;
            }
        }
        // logo..
        if ($request->hasFile('logo')){

            if ($request->logo!=''){

                if (File::exists($settings->logo)){
                    unlink($settings->logo);
                }

                $logo            = 'logo.'.$request->logo->getClientOriginalExtension();
                // logo path
                $logo_url          = 'public/uploads/images/logo/' . $logo;
                //logo base path
                $destinationPath    = base_path() . '/public/uploads/images/logo/';
                $success            = $request->logo->move($destinationPath, $logo);
                if ($success){
                    $logo_urls     = $logo_url ;
                }
            }else{
                $logo_urls         = '' ;
            }
        }
        //footer logo..
        if ($request->hasFile('logo_footer')){
            if ($request->logo_footer!=''){
                if (File::exists($settings->logo_footer)){
                    unlink($settings->logo_footer);
                }
                $logo_footer            = 'logo_footer.'.$request->logo_footer->getClientOriginalExtension();
                // image path
                $logo_footer_url          = 'public/uploads/images/logo/' . $logo_footer;
                //image base path
                $destinationPath    = base_path() . '/public/uploads/images/logo/';
                $success            = $request->logo_footer->move($destinationPath, $logo_footer);
                if ($success){
                    $logo_footer_urls     = $logo_footer_url ;
                }
            }else{
                $logo_footer_urls         = '' ;
            }
        }
        if ($request->name!=''){
            $settings->name = $request->name ;
        }
        if ($request->short_name!=''){
            $settings->short_name = $request->short_name ;
        }
        if ($request->title!=''){
            $settings->title = $request->title ;
        }
        if ($request->footer_content!=''){
            $settings->footer_content = $request->footer_content ;
        }
        if ($request->play_store_url!=''){
            $settings->play_store_url = $request->play_store_url ;
        }
        if ($request->app_store_url!=''){
            $settings->app_store_url = $request->app_store_url ;
        }
        if ($request->favicon!=''){
            $settings->favicon = $favicon_urls ;
        }
        if ($request->icon!=''){
            $settings->icon = $icon_urls ;
        }
        if ($request->logo!=''){
            $settings->logo = $logo_urls ;
        }
        if ($request->logo_footer!=''){
            $settings->logo_footer = $logo_footer_urls ;
        }
        $settings->save();
        $this->setSuccess('Inserted');
        return redirect()->route('admin.settings.index');
    }

    public function maanSettingsUpdate(Request $request,Settings $settings)
    {
        
        //title ,name, short name validation..
        if ($request->title||$request->name||$request->short_name){
            $request->validate([
                'title'=> 'required',
                'name'=> 'required',
                'short_name'=> 'required',
            ]);
        }
        //favicon validation..
        if ($request->favicon!=''){
            $request->validate([
                'favicon'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:100|dimensions:max_width=50,max_height=50',
            ],[

                'favicon.dimensions'    => 'Required favicon maximum 50x50 image',
                'favicon.max'  => 'image size should not be more than 100 kB'
            ]);

        }
        //icon validation..
        if ($request->icon!=''){
            $request->validate([
                'icon'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500|dimensions:max_width=100,max_height=80',
            ],[
                'icon.dimensions'    => 'Required icon maximum 100x80 image',
                'icon.max'  => 'image size should not be more than 500 kB'
            ]);
        }
        //logo validation..
        if ($request->logo!=''){
            $request->validate([
                'logo'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024|dimensions:max_width=200,max_height=200',
            ],[
                'logo.dimensions'    => 'Required logo maximum 200x200 image',
                'logo.max'  => 'image size should not be more than 1024 kB'
            ]);
        }
        //logo footer validation..
        if ($request->logo_footer!=''){
            $request->validate([
                'logo_footer'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024|dimensions:max_width=200,max_height=200',
            ],[
                'logo_footer.dimensions'    => 'Required logo footer maximum 200x200 image',
                'logo_footer.max'  => 'image size should not be more than 1024 kB'
            ]);
        }
        // favicon..
        if ($request->hasFile('favicon')){

            if ($request->favicon!=''){

                if (File::exists($settings->favicon)){
                    unlink($settings->favicon);
                }

                $favicon            = 'favicon.'.$request->favicon->getClientOriginalExtension();
                // image path
                $favicon_url          = 'public/uploads/images/logo/' . $favicon;
                //image base path
                $destinationPath    = base_path() . '/public/uploads/images/logo/';
                $success            = $request->favicon->move($destinationPath, $favicon);
                if ($success){
                    $favicon_urls     = $favicon_url ;
                }
            }else{
                $favicon_urls         = $settings->favicon ;
            }
        }
        //icon..
        if ($request->hasFile('icon')){
            if ($request->icon!=''){
                if (File::exists($settings->icon)){
                    unlink($settings->icon);
                }
                $icon            = 'icon.'.$request->icon->getClientOriginalExtension();
                // icon path
                $icon_url          = 'public/uploads/images/logo/' . $icon;
                //icon base path
                $destinationPath    = base_path() . '/public/uploads/images/logo/';
                $success            = $request->icon->move($destinationPath, $icon);
                if ($success){
                    $icon_urls     = $icon_url ;
                }
            }else{
                $icon_urls         = $settings->icon ;
            }
        }
        // logo..
        if ($request->hasFile('logo')){
            if ($request->logo!=''){
                if (File::exists($settings->logo)){
                    unlink($settings->logo);
                }
                $logo            = 'logo.'.$request->logo->getClientOriginalExtension();
                // logo path
                $logo_url          = 'public/uploads/images/logo/' . $logo;
                //logo base path
                $destinationPath    = base_path() . '/public/uploads/images/logo/';
                $success            = $request->logo->move($destinationPath, $logo);
                if ($success){
                    $logo_urls     = $logo_url ;
                }
            }else{
                $logo_urls         = $settings->logo ;
            }
        }
        //footer logo..
        if ($request->hasFile('logo_footer')){
            if ($request->logo_footer!=''){
                if (File::exists($settings->logo_footer)){
                    unlink($settings->logo_footer);
                }
                $logo_footer            = 'logo_footer.'.$request->logo_footer->getClientOriginalExtension();
                // image path
                $logo_footer_url          = 'public/uploads/images/logo/' . $logo_footer;
                //image base path
                $destinationPath    = base_path() . '/public/uploads/images/logo/';
                $success            = $request->logo_footer->move($destinationPath, $logo_footer);
                if ($success){
                    $logo_footer_urls     = $logo_footer_url ;
                }
            }else{
                $logo_footer_urls         = $settings->logo_footer ;
            }
        }
        if ($request->title){
            $settings->title = $request->title;
        }
        if ($request->name){
            $settings->name = $request->name;
        }
        if ($request->short_name){
            $settings->short_name = $request->short_name;
        }
        if ($request->footer_content){
            $settings->footer_content = $request->footer_content;
        }

            $settings->play_store_url = $request->play_store_url ;


            $settings->app_store_url = $request->app_store_url ;

        if ($request->favicon!=''){
            $settings->favicon = $favicon_urls ;
        }
        if ($request->icon!=''){
            $settings->icon = $icon_urls ;
        }
        if ($request->logo!=''){
            $settings->logo = $logo_urls ;
        }
        if ($request->logo_footer!=''){
            $settings->logo_footer = $logo_footer_urls ;
        }

        $settings->save();

        //session message
        $this->setSuccess('Updated');
        return redirect()->route('admin.settings.index');

    }

    public function maanSettingsDestroy(Settings $settings)
    {
        if (File::exists($settings->favicon)){
            unlink($settings->favicon);
        }
        if (File::exists($settings->icon)){
            unlink($settings->icon);
        }
        if (File::exists($settings->logo)){
            unlink($settings->logo);
        } if (File::exists($settings->logo_footer)){
        unlink($settings->logo_footer);
    }
        $settings->delete();
        return redirect()->route('admin.settings.index');
    }

}
