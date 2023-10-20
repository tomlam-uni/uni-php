<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class VersionRepositoryProvider extends ServiceProvider
{
    /**
     * Register Version repository.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\MasterData\Repositories\VersionRepository', function ($app) {
            return new \App\MasterData\Repositories\impl\DefaultVersionRepository();
        });
    }
}
