<?php

namespace App\Providers;

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
        $this->app->singleton('App\MasterData\Repositories\RegionRepository', function ($app) {
            return new \App\MasterData\Repositories\impl\DefaultRegionRepository();
        });
    }
}
