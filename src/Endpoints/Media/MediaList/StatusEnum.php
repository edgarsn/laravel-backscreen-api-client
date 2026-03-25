<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList;

enum StatusEnum: string
{
    case ANY = 'any';
    case DRAFT = 'draft';
    case PROCESSING = 'processing';
    case READY = 'ready';
    case ARCHIVED = 'archived';
    case ERROR = 'error';
    case NEW = 'new';
    case INGESTED = 'ingested';
    case INGESTING = 'ingesting';
    case VALIDATE = 'validate';
    case VALIDATING = 'validating';
    case VALIDATED = 'validated';
    case TRANSCODING = 'transcoding';
    case PLAYABLE = 'playable';
    case PRIORITY = 'priority';
    case PROCESSED = 'processed';
    case UPLOADED = 'uploaded';
    case APPROVED = 'approved';
}
