<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;
use Newman\LaravelBackscreenApiClient\Support\ValidateImage;

class Images
{
    use CompilesProperties;

    protected ?string $thumbnail = null;

    protected ?string $placeholder = null;

    public function thumbnail(?string $thumbnail): static
    {
        if (! ValidateImage::verify($thumbnail)) {
            throw new \InvalidArgumentException('thumbnail must be a base64 encoded string');
        }

        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function placeholder(?string $placeholder): static
    {
        if (! ValidateImage::verify($placeholder)) {
            throw new \InvalidArgumentException('placeholder must be a base64 encoded string');
        }

        $this->placeholder = $placeholder;

        return $this;
    }
}
