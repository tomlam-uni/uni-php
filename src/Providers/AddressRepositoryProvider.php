<?php

namespace Uni\Providers;

use Illuminate\Support\ServiceProvider;

class AddressRepositoryProvider extends ServiceProvider
{
    /**
     * Register address repository service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Uni\MasterData\Repositories\AddressRepository', function ($app) {
            return new \Uni\MasterData\Repositories\impl\DefaultAddressRepository();
        });
    }
}
