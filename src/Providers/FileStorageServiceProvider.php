<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FileStorageServiceProvider  extends ServiceProvider
{
    /**
     * Register file storage service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\MasterData\Contracts\FileStorageService', function ($app) {
            return new \App\MasterData\Contracts\impl\DefaultFileStorageService();
        });
    }
}
