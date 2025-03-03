<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Live\Create\Enums;

enum EncryptionMethodEnum: string
{
    case NONE = 'none';
    case DRM = 'drm';
    case AES = 'aes';
    case DRMAES = 'drmaes';
}
