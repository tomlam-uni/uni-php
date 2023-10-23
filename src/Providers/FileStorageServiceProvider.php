<?php

namespace Uni\Providers;

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
        $this->app->singleton('Uni\MasterData\Contracts\FileStorageService', function ($app) {
            return new \Uni\MasterData\Contracts\impl\DefaultFileStorageService();
        });
    }
}
