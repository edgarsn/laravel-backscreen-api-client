<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList;

enum PublisherStatusEnum: string
{
    case PUBLISHED = 'published';
    case SCHEDULED = 'scheduled';
    case EXPIRED = 'expired';
    case INGESTING = 'ingesting';
    case INACTIVE = 'inactive';
}
