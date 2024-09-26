<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Live;

use Newman\LaravelTmsApiClient\Endpoints\Live\Off;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class OffTest extends TestCase
{
    public function test_without_parameters(): void
    {
        $this->makeBasicAuthEndpointTest(new Off(1), [], [
            'id' => 1,
        ]);
    }

    public function test_with_id(): void
    {
        $endpoint = new Off(1);
        $endpoint->id(2);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 2,
        ]);
    }
}