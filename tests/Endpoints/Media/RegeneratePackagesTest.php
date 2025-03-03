<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\RegeneratePackages;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class RegeneratePackagesTest extends TestCase
{
    public function test_with_required_arguments(): void
    {
        $this->makeBearerAuthEndpointTest(new RegeneratePackages(123), [], ['id' => 123]);
    }

    public function test_with_package_id(): void
    {
        $endpoint = new RegeneratePackages(123);

        $endpoint->packageId([5, 7]);

        $this->makeBearerAuthEndpointTest($endpoint, [], ['id' => 123, 'package_id' => [5, 7]]);
    }
}
