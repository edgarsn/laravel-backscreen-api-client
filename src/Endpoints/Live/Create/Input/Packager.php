<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Live\Create\Input;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class Packager
{
    use CompilesProperties;

    protected ?int $primary = null;

    protected ?int $backup = null;

    public function primary(int $primary): static
    {
        $this->primary = $primary;

        return $this;
    }

    public function backup(int $backup): static
    {
        $this->backup = $backup;

        return $this;
    }
}
