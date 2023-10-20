<?php

namespace App\Providers;

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
        $this->app->singleton('App\MasterData\Contracts\RankingService', function ($app) {
            return new \App\MasterData\Contracts\impl\DefaultRankingService();
        });    }
}
