<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\EndpointSupport;

use Newman\LaravelTmsApiClient\Concerns\CompilesProperties;
use Newman\LaravelTmsApiClient\EndpointSupport\Enums\CallbackHttpMethodEnum;

class Callback
{
    use CompilesProperties;

    public function __construct(protected string $url, protected CallbackHttpMethodEnum $method)
    {
    }
}
