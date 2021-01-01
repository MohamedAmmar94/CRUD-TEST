<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('categories')) {
            $allcategory = Category::get();
            $parent_category=Category::whereNull('parent')->get();
           \View::share('allcategory', $allcategory);
           \View::share('parent_category', $parent_category);
       }

    }
}
