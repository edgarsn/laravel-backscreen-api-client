<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class Presentation
{
    use CompilesProperties;

    protected ?int $mode = null;

    protected ?PresentationConfig $config = null;

    public function mode(int $mode): static
    {
        if (! in_array($mode, [0, 1])) {
            throw new \InvalidArgumentException('mode must be 0 or 1');
        }

        $this->mode = $mode;

        return $this;
    }

    public function config(PresentationConfig $config): static
    {
        $this->config = $config;

        return $this;
    }
}
