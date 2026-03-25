<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\Enums;

enum MaterialChangeTypeEnum: string
{
    case THUMBNAIL = 'thumbnail';
    case PLACEHOLDER = 'placeholder';
}
