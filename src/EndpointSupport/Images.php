<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\EndpointSupport;

use Newman\LaravelTmsApiClient\Concerns\CompilesProperties;

class Images
{
    use CompilesProperties;

    /**
     * @var string|null
     */
    protected $thumbnail = null;

    /**
     * @var string|null
     */
    protected $placeholder = null;

    /**
     * @var string|null
     */
    protected $playbutton = null;

    /**
     * @var string|null
     */
    protected $logo = null;

    public function thumbnail(?string $imageBase64): static
    {
        if (!$this->verifyBase64Encoded($imageBase64)) {
            throw new \InvalidArgumentException('thumbnail must be a base64 encoded string');
        }

        $this->thumbnail = $imageBase64;

        return $this;
    }

    public function placeholder(?string $imageBase64): static
    {
        if (!$this->verifyBase64Encoded($imageBase64)) {
            throw new \InvalidArgumentException('placeholder must be a base64 encoded string');
        }

        $this->placeholder = $imageBase64;

        return $this;
    }

    public function playbutton(?string $imageBase64): static
    {
        if (!$this->verifyBase64Encoded($imageBase64)) {
            throw new \InvalidArgumentException('playbutton must be a base64 encoded string');
        }

        $this->playbutton = $imageBase64;

        return $this;
    }

    public function logo(?string $imageBase64): static
    {
        if (!$this->verifyBase64Encoded($imageBase64)) {
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

        $decoded = base64_decode($value, true);

        if ($decoded === false) {
            return false;
        }

        return base64_encode($decoded) === $value;
    }
}
