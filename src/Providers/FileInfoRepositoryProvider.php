<?php

namespace Uni\Providers;

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
        $this->app->singleton('Uni\MasterData\Repositories\FileInfoRepository', function ($app) {
            return new \Uni\MasterData\Repositories\impl\DefaultFileInfoRepository();
        });
    }
}
