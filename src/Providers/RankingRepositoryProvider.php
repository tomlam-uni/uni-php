<?php

namespace Uni\Providers;

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
        $this->app->singleton('Uni\MasterData\Repositories\RankingRepository', function ($app) {
            return new \Uni\MasterData\Repositories\impl\DefaultRankingRepository();
        });
    }
}
