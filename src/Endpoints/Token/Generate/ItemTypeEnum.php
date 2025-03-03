<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Token\Generate;

enum ItemTypeEnum: string
{
    case LIVE = 'live';
    case MEDIA = 'media';
    case RECORD = 'record';
    case FILE = 'file';
}
