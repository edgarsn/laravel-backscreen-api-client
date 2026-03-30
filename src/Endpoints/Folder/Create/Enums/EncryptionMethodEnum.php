<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Enums;

enum EncryptionMethodEnum: string
{
    case DRM = 'drm';
    case AES = 'aes';
    case DRMAES = 'drmaes';
}
