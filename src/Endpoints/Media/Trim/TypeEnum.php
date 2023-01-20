<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Media\Trim;

enum TypeEnum: string
{
    case NEW = 'new';
    case EXISTING = 'existing';
}
