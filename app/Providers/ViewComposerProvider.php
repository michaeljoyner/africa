<?php

namespace App\Providers;

use App\Expeditions\Expedition;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('front.partials.footer', function ($view) {
            $latestExpeditions = Expedition::where('published', 1)->latest()->limit(3)->pluck('name', 'slug');

            return $view->with(compact('latestExpeditions'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
