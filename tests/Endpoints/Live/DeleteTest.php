<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Live;

use Newman\LaravelBackscreenApiClient\Endpoints\Live\Delete;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class DeleteTest extends TestCase
{
    public function test_without_parameters(): void
    {
        $this->makeBasicAuthEndpointTest(new Delete(1), [], [
            'id' => 1,
        ]);
    }

    public function test_with_id(): void
    {
        $endpoint = new Delete(1);
        $endpoint->id(2);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 2,
        ]);
    }

    public function test_with_delete_media(): void
    {
        $endpoint = new Delete(1);
        $endpoint->deleteMedia(true);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'delete_media' => 1,
        ]);
    }

    public function test_with_force(): void
    {
        $endpoint = new Delete(1);
        $endpoint->force(true);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'force' => 1,
        ]);
    }
}
