<?php

namespace App\Providers;

use App\Models\Theme;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //check if in production, if so, force https
        if(config('app.env') === 'production'){
            //force to use https
            URL::forceScheme('https');
        }

        View::composer(['layouts.app'], function($view){

            $view->with('themes', Theme::all());

        });
    }
}
