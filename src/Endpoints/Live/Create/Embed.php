<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Live\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class Embed
{
    use CompilesProperties;

    protected ?bool $enable_public = null;

    protected ?string $public_password = null;

    protected ?bool $enable_preview = null;

    public function enablePublic(bool $enable_public): static
    {
        $this->enable_public = $enable_public;

        return $this;
    }

    public function publicPassword(string $public_password): static
    {
        $this->public_password = $public_password;

        return $this;
    }

    public function enablePreview(bool $enable_preview): static
    {
        $this->enable_preview = $enable_preview;

        return $this;
    }
}
