<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class Language
{
    use CompilesProperties;

    protected ?string $default = null;

    protected ?string $order = null;

    public function default(string $default): static
    {
        $this->default = $default;

        return $this;
    }

    public function order(string $order): static
    {
        $this->order = $order;

        return $this;
    }
}
