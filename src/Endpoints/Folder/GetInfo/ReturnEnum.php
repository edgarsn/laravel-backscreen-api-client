<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\GetInfo;

enum ReturnEnum: string
{
    case DEFAULT_OUTGOING_PATTERNS = 'default_outgoing_patterns';
    case MULTI_AUDIO = 'multi_audio';
}
