<?php

namespace App\Providers;

use App\MasterData\Contracts\impl\DefaultMDMQueryService;
use Illuminate\Support\ServiceProvider;

class MDMQueryServiceProvider extends ServiceProvider
{
    /**
     * Register master data query service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\MasterData\Contracts\MDMQueryService', function ($app) {
            return new DefaultMDMQueryService();
        });
    }
}
