<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DictionaryRepositoryProvider extends ServiceProvider
{
    /**
     * Register dictionary repository service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\MasterData\Repositories\DictionaryRepository', function ($app) {
            return new \App\MasterData\Repositories\impl\DefaultDictionaryRepository();
        });
    }
}
