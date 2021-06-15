<?php

namespace App\Providers;

use App\Addon;
use App\Category;
use App\Menutype;
use App\Order;
use App\Product;
use App\Promotion;
use App\Setting;
use App\User;
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
        
        app()->bind('promotions', function(){

            return Promotion::where('status', true)->get();
        });

        app()->bind('addons', function(){

            return Addon::where('status', true)->get();
        });

        app()->bind('settings', function(){

            return Setting::find(1);
        });

        app()->bind('waiter', function(){

            return User::where('type', 4)->get();
        });

        app()->bind('allmenus', function(){

            return Product::where('status', 1)->get();
        });

        app()->bind('saleslog', function(){

            return User::with('ordersPosted')->find(auth()->user()->id);
        });

        app()->bind('members', function(){

            return User::where('type', 3)->get();
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
