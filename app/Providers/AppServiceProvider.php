<?php

namespace App\Providers;

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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        // Load the IDe helper and Debugbar service providers only if the environment is local.
        if($this->app->environment('local')){
            $this->app->register('Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider');
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');

            // Load Debugbar's Facade.
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Debugbar', 'Barryvdh\Debugbar\Facade');
        }
    }
}
