<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\EndpointSupport;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;
use Newman\LaravelBackscreenApiClient\EndpointSupport\Enums\CallbackHttpMethodEnum;

class Callback
{
    use CompilesProperties;

    public function __construct(protected string $url, protected CallbackHttpMethodEnum $method) {}
}
