<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests;

use Newman\LaravelBackscreenApiClient\ServiceProvider;
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
