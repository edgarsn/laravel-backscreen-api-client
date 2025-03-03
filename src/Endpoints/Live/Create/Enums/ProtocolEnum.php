<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Live\Create\Enums;

enum ProtocolEnum: string
{
    case SRT = 'srt';
    case RTMP = 'rtmp';
}
