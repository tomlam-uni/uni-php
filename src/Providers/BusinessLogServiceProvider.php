<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BusinessLogServiceProvider extends ServiceProvider
{
    /**
     * Register business log service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\MasterData\Contracts\BusinessLogService', function($app) {
            return new \App\MasterData\Contracts\impl\DatabaseBusinessLogService();
        });
    }
}
