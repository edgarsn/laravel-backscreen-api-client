<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums;

enum ProtocolEnum: string
{
    case HTTP = 'http';
    case HTTPS = 'https';
}
