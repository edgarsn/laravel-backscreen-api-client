<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Enums;

enum DuplicateActionEnum: string
{
    case APPEND = 'append';
    case REPLACE = 'replace';
}
