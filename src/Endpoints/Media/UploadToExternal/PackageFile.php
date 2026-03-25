<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\UploadToExternal;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class PackageFile
{
    use CompilesProperties;

    public function __construct(
        protected int $package_id,
        protected int $file_id,
    ) {}
}
