<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Enums;

enum ShowRelatedTypeEnum: string
{
    case FOLDER = 'folder';
    case GROUP = 'group';
}
