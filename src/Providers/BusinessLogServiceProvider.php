<?php

namespace Uni\Providers;

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
        $this->app->singleton('Uni\MasterData\Contracts\BusinessLogService', function ($app) {
            return new \Uni\MasterData\Contracts\impl\DatabaseBusinessLogService();
        });
    }
}
