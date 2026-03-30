<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class MultiAudioConditions
{
    use CompilesProperties;

    protected ?string $file_ext = null;

    public function fileExt(string $file_ext): static
    {
        $this->file_ext = $file_ext;

        return $this;
    }
}
