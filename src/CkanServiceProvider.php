<?php

namespace Germanazo\CkanApi;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use Germanazo\CkanApi\CkanApiClient;

class CkanServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ckan_api.php', 'ckan_api');

        $this->publishes([
            __DIR__ . '/../config/ckan_api.php' => config_path('ckan_api.php'),
        ]);
    }

    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->bind('Germanazo\CkanApi\CkanApiClient', function () {

            // Build http client
            $config = [
                'base_uri' => config('ckan_api.url'),
                'headers' => ['Authorization' => config('ckan_api.api_key')],
            ];

            return new CkanApiClient(new Client($config));
        });

        $app->alias('Germanazo\CkanApi\CkanApiClient', 'CkanApi');
    }
}