<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MessageTemplateRepositoryProvider extends ServiceProvider
{
    /**
     * Register region repository service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\MasterData\Repositories\MessageTemplateRepository', function ($app) {
            return new \App\MasterData\Repositories\impl\DefaultMessageTemplateRepository();
        });
    }
}
