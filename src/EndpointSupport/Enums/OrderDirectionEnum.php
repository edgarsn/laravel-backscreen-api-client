<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\EndpointSupport\Enums;

enum OrderDirectionEnum: string
{
    case ASC = 'asc';
    case DESC = 'desc';
}
