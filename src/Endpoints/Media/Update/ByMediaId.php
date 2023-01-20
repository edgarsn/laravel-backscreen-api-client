<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Media\Update;

class ByMediaId implements ByContract
{
    public function __construct(protected int $media_id)
    {
    }

    public function getFieldName(): string
    {
        return 'id';
    }

    public function getValue(): int|string
    {
        return $this->media_id;
    }
}
