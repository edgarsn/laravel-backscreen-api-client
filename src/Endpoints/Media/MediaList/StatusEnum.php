<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Media\MediaList;

enum StatusEnum: string
{
    case ANY = 'any';
    case ERROR = 'error';
    case INGESTED = 'ingested';
    case NEW = 'new';
    case PLAYABLE = 'playable';
    case PRIORITY = 'priority';
    case PROCESSED = 'processed';
    case PROCESSING = 'processing';
    case UPLOADED = 'uploaded';
    case VALIDATED = 'validated';
    case APPROVED = 'approved';
}
