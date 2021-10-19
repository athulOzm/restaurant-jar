<?php

namespace App\Providers;

use App\Addon;
use App\Branch;
use App\Category;
use App\Deliverylocation;
use App\Menutype;
use App\Order;
use App\Product;
use App\Promotion;
use App\Setting;
use App\Table;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use phpDocumentor\Reflection\Location;

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

            // $re =  $bpro->each(function($bpro){
                

            //     return Branch::find(Session::get('branch')->id)->products()->where('id', $bpro->id);
            // });

            // return $re;

        
        });

        app()->bind('menutypesforkot', function(){

            return Menutype::whereHas('products', function($q){
                $q->where('status', '=', 1);
            })->where('id', '!=', 1)->get();
        });

        app()->bind('menutypesforrep', function(){

            return Menutype::where('id', '!=', 1)->get();
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

        app()->bind('saleslog2', function(){

            return Order::where('status', 3)->where('branch_id', Session::get('branch')->id)->latest()->take(50)->get();
        });

        app()->bind('saleslog4', function(){

            return Order::where('status', 4)->where('branch_id', Session::get('branch')->id)->latest()->take(50)->get();
        });

        app()->bind('members', function(){

            return User::where('type', 3)->get();
        });

        app()->bind('branches', function(){

            return Branch::all();
        });

        app()->bind('locations', function(){

            return Deliverylocation::all();
        });

        app()->bind('tables', function(){

            return Table::all();
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
