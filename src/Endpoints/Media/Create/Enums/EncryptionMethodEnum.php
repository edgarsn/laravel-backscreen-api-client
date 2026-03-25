<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums;

enum EncryptionMethodEnum: string
{
    case DRM = 'drm';
    case AES = 'aes';
    case DRMAES = 'drmaes';
}
