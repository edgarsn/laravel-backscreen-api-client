<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Media\Manifest;

use Newman\LaravelTmsApiClient\Endpoints\Media\Manifest\Delete;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class DeleteTest extends TestCase
{
    public function test(): void
    {
        $this->makeBasicAuthEndpointTest(new Delete(123), [], ['id' => 123]);
    }
}
