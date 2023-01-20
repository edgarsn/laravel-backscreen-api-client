<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests;

use Newman\LaravelTmsApiClient\ServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

    }

    protected function getPackageProviders($app): array
    {
        return [
            ServiceProvider::class,
        ];
    }
}
