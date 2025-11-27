<?php

namespace App\Providers;

use App\Models\Advertisement;
use App\Models\Company;
use App\Models\Seooptimization;
use App\Models\Settings;
use App\Models\Socialshare;
use App\Models\Theme;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('seooptimizations')) {
            View::share('seooptimization',Seooptimization::first());
        }
        if (Schema::hasTable('settings')) {
            View::share('settings',Settings::first());
        }
        if (Schema::hasTable('companies')) {
            View::share('companyInfo',Company::first());
        }
        if (Schema::hasTable('socialshares')) {
            View::share('socials',Socialshare::take(5)->get());
        }
        if (Schema::hasTable('themes')) {
            View::share('themes',Theme::where('is_active',1)->first());
        }
        if (Schema::hasTable('advertisements')) {
            View::share('advertisement',Advertisement::latest()->first());
        }
    }
}
