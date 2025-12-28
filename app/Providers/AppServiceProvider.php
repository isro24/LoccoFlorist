<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('categories', Category::all());
    }
}
