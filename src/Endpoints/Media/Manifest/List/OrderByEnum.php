<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Manifest\List;

enum OrderByEnum: string
{
    case ID = 'id';
    case MEDIA_ID = 'media_id';
    case NAME = 'name';
    case PACKAGE_ID = 'package_id';
}
