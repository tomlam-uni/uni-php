<?php

namespace Provider;

use Illuminate\Support\ServiceProvider;

class DBLSServiceProvider extends ServiceProvider
{
    public function register() {
        $this->app->singleton('src\MasterData\Contracts\BusinessLogService', function ($app) {
            return new \src\MasterData\Contracts\impl\DatabaseBusinessLogService();
        });
    }
}
