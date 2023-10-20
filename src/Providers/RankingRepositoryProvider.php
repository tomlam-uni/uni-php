<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RankingRepositoryProvider extends ServiceProvider
{
    /**
     * Register ranking repository service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\MasterData\Repositories\RankingRepository', function ($app) {
            return new \App\MasterData\Repositories\impl\DefaultRankingRepository();
        });
    }
}
