<?php

namespace Uni\Providers;

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
        $this->app->singleton('Uni\MasterData\Repositories\MessageTemplateRepository', function ($app) {
            return new \Uni\MasterData\Repositories\impl\DefaultMessageTemplateRepository();
        });
    }
}
