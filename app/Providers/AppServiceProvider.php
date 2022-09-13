<?php

namespace App\Providers;

use Schema;

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
        $this->app['request']->server->set('HTTPS', $this->app->environment() != 'local');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(config('app.env') === 'testing') {
            \URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);
    }
}
