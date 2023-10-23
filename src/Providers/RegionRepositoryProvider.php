<?php

namespace Uni\Providers;

use Illuminate\Support\ServiceProvider;

class RegionRepositoryProvider extends ServiceProvider
{
    /**
     * Register region repository service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Uni\MasterData\Repositories\RegionRepository', function ($app) {
            return new \Uni\MasterData\Repositories\impl\DefaultRegionRepository();
        });
    }
}
