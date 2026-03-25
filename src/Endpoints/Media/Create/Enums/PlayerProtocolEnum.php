<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums;

enum PlayerProtocolEnum: string
{
    case HLS = 'hls';
    case DASH = 'dash';
}
