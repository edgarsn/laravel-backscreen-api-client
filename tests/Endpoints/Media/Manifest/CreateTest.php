<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Media\Manifest;

use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Endpoints\Media\Manifest\Create;

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
