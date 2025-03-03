<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class Files
{
    use CompilesProperties;

    protected ?string $url = null;

    protected ?string $username = null;

    protected ?string $password = null;

    protected ?int $bitrate = null;

    protected ?string $lang = null;

    public function url(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function username(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function password(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function bitrate(int $bitrate): static
    {
        $this->bitrate = $bitrate;

        return $this;
    }

    public function lang(string $lang): static
    {
        $this->lang = $lang;

        return $this;
    }
}
