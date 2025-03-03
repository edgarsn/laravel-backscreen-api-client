<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\EndpointSupport\Enums;

enum CallbackHttpMethodEnum: string
{
    case GET = 'get';
    case POST = 'post';
}
