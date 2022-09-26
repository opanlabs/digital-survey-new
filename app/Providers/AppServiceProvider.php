<?php

namespace App\Providers;
use Auth;
use Blade;

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

        // custome direction not super admin
        Blade::if('notsuperadmin', function () {
            return auth()->check() && auth()->user()->roles->role != 'Super Admin';
        });

        // custome direction admin
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->roles->role == 'Super Admin' or auth()->user()->roles->role == 'Admin';
        });

        if(config('app.env') === 'testing') {
            \URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);
    }
}
