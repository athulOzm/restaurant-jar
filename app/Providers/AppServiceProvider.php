<?php

namespace App\Providers;

use App\Addon;
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
        app()->bind('menutypesforpos', function(){

            return Menutype::whereHas('products', function($q){
                $q->where('status', '=', 1);
            })->get();
        });
        app()->bind('mcategories', function(){

            return Category::where('parant_id', null)->get();
        });

        app()->bind('addons', function(){

            return Addon::where('status', true)->get();
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
