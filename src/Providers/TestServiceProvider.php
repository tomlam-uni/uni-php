<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Register business log service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\TestProject\Contracts\TestService', function($app) {
            return new \App\TestProject\Contracts\impl\DefaultTestService();
        });
    }
}
