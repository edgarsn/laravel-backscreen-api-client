<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Update;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\Enums\MaterialChangeTypeEnum;

class MaterialChange
{
    use CompilesProperties;

    protected ?MaterialChangeTypeEnum $type = null;

    protected ?int $timestamp = null;

    public function type(MaterialChangeTypeEnum $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function timestamp(int $timestamp): static
    {
        $this->timestamp = $timestamp;

        return $this;
    }
}
