<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Support;

use Newman\LaravelTmsApiClient\Concerns\CompilesProperties;

class TestClassWithProperties
{
    use CompilesProperties;

    protected ?string $name = 'Name';
    protected ?string $description = 'Description';
}
