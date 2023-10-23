<?php

namespace Uni\Providers;

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
        $this->app->singleton('Uni\MasterData\Repositories\AgreementRepository', function ($app) {
            return new \Uni\MasterData\Repositories\impl\DefaultAgreementRepository();
        });
    }
}
