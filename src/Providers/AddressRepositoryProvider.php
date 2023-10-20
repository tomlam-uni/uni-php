<?php

namespace App\Providers;

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
        $this->app->singleton('App\MasterData\Repositories\AddressRepository', function ($app) {
            return new \App\MasterData\Repositories\impl\DefaultAddressRepository();
        });
    }
}
