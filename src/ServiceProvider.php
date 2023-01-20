<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient;

use Newman\LaravelTmsApiClient\Contracts\ClientContract;
use Newman\LaravelTmsApiClient\Contracts\TmsApiContract;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPublishing();
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/tms-api.php', 'tms-api');

        $this->app->singleton(TmsApiContract::class, TmsApi::class);
        $this->app->singleton(ClientContract::class, Client::class);
    }

    /**
     * Register the package's publishable resources.
     */
    private function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/tms-api.php' => config_path('tms-api.php'),
            ], 'tms-api-config');
        }
    }
}
