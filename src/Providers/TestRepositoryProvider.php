<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TestRepositoryProvider extends ServiceProvider
{
    /**
     * Register region repository service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\TestProject\Repositories\TestRepository', function($app) {
            return new \App\TestProject\Repositories\impl\DefaultTestRepository();
        });
    }
}
