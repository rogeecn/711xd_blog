<?php

namespace App\Providers;

use Collective\Html\HtmlFacade;
use Illuminate\Support\Facades\Blade;
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
        //
        Blade::directive("seo_title", function ($expresion = []) {
            $expresion = array_wrap($expresion);
            $expresion[] = env('APP_NAME');

            return implode(" | ", $expresion);
        });

        Blade::directive("seo_keywords", function ($expresion = []) {
            $expresion = array_wrap($expresion);
            return implode(",", $expresion);
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
