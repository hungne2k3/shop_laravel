<?php

namespace App\Providers;

use App\Http\View\Composers\CartComposer;
use App\Http\View\Composers\MenuComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
// use Illuminate\View\View;

use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // truyền khai báo MenuComposer sang (Hiển thị header)
        view::composer('Themes.Layouts.header', MenuComposer::class);

        // truyền khai báo CartComposer sang (Hiển thị Cart)
        view::composer('Themes.Layouts.cart', CartComposer::class);
    }
}