<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Manifest;

use Newman\LaravelBackscreenApiClient\Contracts\EndpointContract;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Manifest\Create;

class CreateTest extends ManifestCreateAndUpdateTestCase
{
    protected function getIdFieldName(): string
    {
        return 'media_id';
    }

    protected function getEndpoint(): EndpointContract
    {
        return new Create(123);
    }
}
