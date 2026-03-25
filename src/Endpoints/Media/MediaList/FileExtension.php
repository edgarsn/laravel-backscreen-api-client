<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class FileExtension
{
    use CompilesProperties;

    /**
     * @var array<string>|null
     */
    protected ?array $source = null;

    /**
     * @param  array<string>  $source
     */
    public function source(array $source): static
    {
        $this->source = $source;

        return $this;
    }
}
