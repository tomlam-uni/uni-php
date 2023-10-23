<?php

namespace Uni\Providers;

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
        $this->app->singleton('Uni\MasterData\Repositories\DictionaryRepository', function ($app) {
            return new \Uni\MasterData\Repositories\impl\DefaultDictionaryRepository();
        });
    }
}
