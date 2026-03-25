<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Publish;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class PublishTest extends TestCase
{
    public function test_with_single_id_published(): void
    {
        $this->makeBearerAuthEndpointTest(new Publish(123, 1), [], [
            'id' => 123,
            'published' => 1,
        ]);
    }

    public function test_with_single_id_unpublished(): void
    {
        $this->makeBearerAuthEndpointTest(new Publish(123, 0), [], [
            'id' => 123,
            'published' => 0,
        ]);
    }

    public function test_with_multiple_ids(): void
    {
        $this->makeBearerAuthEndpointTest(new Publish([1, 2, 3], 1), [], [
            'id' => [1, 2, 3],
            'published' => 1,
        ]);
    }

    public function test_published_invalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('published must be 0 or 1');
        new Publish(123, 2);
    }
}
