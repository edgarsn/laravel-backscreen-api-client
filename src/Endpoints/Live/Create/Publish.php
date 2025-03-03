<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Live\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class Publish
{
    use CompilesProperties;

    protected ?string $prefix = null;

    public function prefix(string $prefix): static
    {
        $this->prefix = $prefix;

        return $this;
    }
}
