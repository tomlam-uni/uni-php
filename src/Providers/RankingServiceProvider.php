<?php

namespace Uni\Providers;

use Illuminate\Support\ServiceProvider;

class RankingServiceProvider extends ServiceProvider
{
    /**
     * Register ranking service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Uni\MasterData\Contracts\RankingService', function ($app) {
            return new \Uni\MasterData\Contracts\impl\DefaultRankingService();
        });    }
}
