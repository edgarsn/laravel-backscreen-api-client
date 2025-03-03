<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Manifest;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Manifest\Delete;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class DeleteTest extends TestCase
{
    public function test(): void
    {
        $this->makeBasicAuthEndpointTest(new Delete(123), [], ['id' => 123]);
    }
}
