<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Media\Create;

use Newman\LaravelTmsApiClient\Concerns\CompilesProperties;

class Tags
{
    use CompilesProperties;

    /**
     * @var array<string>|null
     */
    protected ?array $set = null;

    /**
     * @var array<string>|null
     */
    protected ?array $add = null;

    /**
     * @param array<string> $set
     */
    public function set(array $set): static
    {
        $this->set = $set;

        return $this;
    }

    /**
     * @param array<string> $add
     */
    public function add(array $add): static
    {
        $this->add = $add;

        return $this;
    }
}