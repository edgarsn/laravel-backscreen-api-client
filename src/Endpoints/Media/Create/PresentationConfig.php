<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class PresentationConfig
{
    use CompilesProperties;

    protected ?int $file_id = null;

    protected ?string $url = null;

    /**
     * @var string[]|null
     */
    protected ?array $slides = null;

    public function fileId(int $file_id): static
    {
        $this->file_id = $file_id;

        return $this;
    }

    public function url(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param  string[]  $slides
     */
    public function slides(array $slides): static
    {
        $this->slides = $slides;

        return $this;
    }
}
