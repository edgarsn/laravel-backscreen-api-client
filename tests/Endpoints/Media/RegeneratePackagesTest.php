<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Media;

use Newman\LaravelTmsApiClient\Endpoints\Media\RegeneratePackages;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class RegeneratePackagesTest extends TestCase
{
    public function test_with_required_arguments(): void
    {
        $this->makeBearerAuthEndpointTest(new RegeneratePackages(123), [], ['id' => 123]);
    }

    public function test_with_packageId(): void
    {
        $endpoint = new RegeneratePackages(123);

        $endpoint->packageId([5, 7]);

        $this->makeBearerAuthEndpointTest($endpoint, [], ['id' => 123, 'package_id' => [5, 7]]);
    }
}
