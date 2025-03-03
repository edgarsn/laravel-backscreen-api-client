<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Media\Update;

class ByAssetId implements ByContract
{
    public function __construct(protected string $asset_id) {}

    public function getFieldName(): string
    {
        return 'asset_id';
    }

    public function getValue(): int|string
    {
        return $this->asset_id;
    }
}
