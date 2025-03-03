<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Update;

interface ByContract
{
    public function getFieldName(): string;

    public function getValue(): int|string;
}
