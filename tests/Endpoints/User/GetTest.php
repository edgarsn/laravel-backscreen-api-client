<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\User;

use Newman\LaravelTmsApiClient\Endpoints\User\Get;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class GetTest extends TestCase
{
    public function test(): void
    {
        $this->makeBearerAuthEndpointTest(new Get());
    }

    public function test_with_return(): void
    {
        $endpoint = new Get();

        $endpoint->return(['client.limits']);

        $this->makeBearerAuthEndpointTest($endpoint, [
            'return' => ['client.limits']
        ]);
    }
}
