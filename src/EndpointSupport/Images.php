<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\EndpointSupport;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class Images
{
    use CompilesProperties;

    protected ?string $thumbnail = null;

    protected ?string $placeholder = null;

    protected ?string $playbutton = null;

    protected ?string $logo = null;

    public function thumbnail(?string $imageBase64): static
    {
        if (! $this->verifyBase64Encoded($imageBase64)) {
            throw new \InvalidArgumentException('thumbnail must be a base64 encoded string');
        }

        $this->thumbnail = $imageBase64;

        return $this;
    }

    public function placeholder(?string $imageBase64): static
    {
        if (! $this->verifyBase64Encoded($imageBase64)) {
            throw new \InvalidArgumentException('placeholder must be a base64 encoded string');
        }

        $this->placeholder = $imageBase64;

        return $this;
    }

    public function playbutton(?string $imageBase64): static
    {
        if (! $this->verifyBase64Encoded($imageBase64)) {
            throw new \InvalidArgumentException('playbutton must be a base64 encoded string');
        }

        $this->playbutton = $imageBase64;

        return $this;
    }

    public function logo(?string $imageBase64): static
    {
        if (! $this->verifyBase64Encoded($imageBase64)) {
            throw new \InvalidArgumentException('logo must be a base64 encoded string');
        }

        $this->logo = $imageBase64;

        return $this;
    }

    private function verifyBase64Encoded(?string $value): bool
    {
        if ($value === null) {
            return false;
        }

        if (! str_contains($value, 'data:') || ! str_contains($value, 'base64,')) {
            return false;
        }

        $base64 = substr($value, strpos($value, 'base64,') + strlen('base64,'));

        $decoded = base64_decode($base64, true);

        if ($decoded === false) {
            return false;
        }

        return base64_encode($decoded) === $base64;
    }
}
