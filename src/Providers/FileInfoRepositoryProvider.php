<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FileInfoRepositoryProvider extends ServiceProvider
{
    /**
     * Register FileInfo repository service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\MasterData\Repositories\FileInfoRepository', function ($app) {
            return new \App\MasterData\Repositories\impl\DefaultFileInfoRepository();
        });
    }
}
