<?php

namespace App\Providers;
use App\Profile;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            $profile=Profile::find(1);
            $logo_name=$profile->image;
            $view->with('logo_name',$logo_name);

        });
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
