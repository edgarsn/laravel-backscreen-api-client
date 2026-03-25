<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\EndpointSupport;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;
use Newman\LaravelBackscreenApiClient\Support\ValidateImage;

class Images
{
    use CompilesProperties;

    protected ?string $thumbnail = null;

    protected ?string $placeholder = null;

    protected ?string $playbutton = null;

    protected ?string $logo = null;

    public function thumbnail(?string $imageBase64): static
    {
        if (! ValidateImage::verify($imageBase64)) {
            throw new \InvalidArgumentException('thumbnail must be a base64 encoded string');
        }

        $this->thumbnail = $imageBase64;

        return $this;
    }

    public function placeholder(?string $imageBase64): static
    {
        if (! ValidateImage::verify($imageBase64)) {
            throw new \InvalidArgumentException('placeholder must be a base64 encoded string');
        }

        $this->placeholder = $imageBase64;

        return $this;
    }

    public function playbutton(?string $imageBase64): static
    {
        if (! ValidateImage::verify($imageBase64)) {
            throw new \InvalidArgumentException('playbutton must be a base64 encoded string');
        }

        $this->playbutton = $imageBase64;

        return $this;
    }

    public function logo(?string $imageBase64): static
    {
        if (! ValidateImage::verify($imageBase64)) {
            throw new \InvalidArgumentException('logo must be a base64 encoded string');
        }

        $this->logo = $imageBase64;

        return $this;
    }
}
