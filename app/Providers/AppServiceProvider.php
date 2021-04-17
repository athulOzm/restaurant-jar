<?php

namespace App\Providers;

use App\Category;
use App\Menutype;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind('allCategories', function(){

            return Category::all();
        });
        app()->bind('menutypes', function(){

            return Menutype::all();
        });
        app()->bind('mcategories', function(){

            return Category::where('parant_id', null)->get();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         Schema::defaultStringLength(191);
    }
}
