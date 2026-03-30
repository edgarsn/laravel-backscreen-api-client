<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Enums;

enum AutoTranscodeConditionEnum: string
{
    case MINUTES = 'minutes';
    case MANIFEST = 'manifest';
}
