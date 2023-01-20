<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Media\Manifest;

use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Endpoints\Media\Manifest\Update;

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
