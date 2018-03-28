<?php

namespace App\Providers;

use App\Blog;
use App\Tag;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('blogs') && Schema::hasTable('tags')) {
            $menus = Tag::lists()->get();
            View::share('menus', $menus);

            $months = [
                1 => 'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ];
            $archives = Blog::getArchive()->get();
            View::share('months', $months);
            View::share('archives', $archives);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
