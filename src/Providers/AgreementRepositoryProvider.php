<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AgreementRepositoryProvider extends ServiceProvider
{
    /**
     * Register agreement repository service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\MasterData\Repositories\AgreementRepository', function ($app) {
            return new \App\MasterData\Repositories\impl\DefaultAgreementRepository();
        });
    }
}
