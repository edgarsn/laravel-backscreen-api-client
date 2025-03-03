<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient;

use Newman\LaravelBackscreenApiClient\Contracts\ClientContract;
use Newman\LaravelBackscreenApiClient\Contracts\TmsApiContract;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap any package services.
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
        $this->mergeConfigFrom(__DIR__.'/../config/backscreen-api.php', 'backscreen-api');

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
                __DIR__.'/../config/backscreen-api.php' => config_path('backscreen-api.php'),
            ], 'backscreen-api-config');
        }
    }
}
