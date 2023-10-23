<?php

namespace Uni\Providers;

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
        $this->app->singleton('Uni\MasterData\Repositories\VersionRepository', function ($app) {
            return new \Uni\MasterData\Repositories\impl\DefaultVersionRepository();
        });
    }
}
