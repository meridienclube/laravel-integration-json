<?php

namespace ConfrariaWeb\IntegrationJson\Providers;

use Illuminate\Support\ServiceProvider;
use MeridienClube\Meridien\Services\Integrations\JsonService;

class IntegrationJsonServiceProvider extends ServiceProvider
{

    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind('IntegrationJsonService', function () {
            return new JsonService();
        });
    }

}
