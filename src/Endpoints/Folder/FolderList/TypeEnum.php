<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\FolderList;

enum TypeEnum: string
{
    case LIVE = 'live';
    case MEDIA = 'media';
}
