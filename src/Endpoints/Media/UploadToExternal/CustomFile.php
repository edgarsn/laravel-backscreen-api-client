<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\UploadToExternal;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class CustomFile
{
    use CompilesProperties;

    public function __construct(
        protected int $file_id,
        protected string $filename,
    ) {}
}
