<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Delete;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class DeleteTest extends TestCase
{
    public function test_with_single_id(): void
    {
        $this->makeBasicAuthEndpointTest(new Delete(123), ['id' => [123]]);
    }

    public function test_it_accepts_multiple_ids(): void
    {
        $this->makeBasicAuthEndpointTest(new Delete([123, 456]), ['id' => [123, 456]]);
    }
}
