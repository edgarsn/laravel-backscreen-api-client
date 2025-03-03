<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Manifest;

use Newman\LaravelBackscreenApiClient\Contracts\EndpointContract;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Manifest\Update;

class UpdateTest extends ManifestCreateAndUpdateTestCase
{
    protected function getIdFieldName(): string
    {
        return 'id';
    }

    protected function getEndpoint(): EndpointContract
    {
        return new Update(123);
    }
}
