<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Support;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class TestClassWithProperties
{
    use CompilesProperties;

    protected ?string $name = 'Name';

    protected ?string $description = 'Description';
}
