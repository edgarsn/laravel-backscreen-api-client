<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Media;

use Newman\LaravelTmsApiClient\Endpoints\Media\CloneMedia;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class CloneMediaTest extends TestCase
{
    public function test_with_required_arguments(): void
    {
        $this->makeBearerAuthEndpointTest(new CloneMedia(123, 'River_Daugava'), [], ['id' => 123, 'asset_id' => 'River_Daugava']);
    }

    public function test_with_name(): void
    {
        $endpoint = new CloneMedia(123, 'River_Daugava');
        $endpoint->name('River "Daugava"');

        $this->makeBearerAuthEndpointTest($endpoint, [], ['id' => 123, 'asset_id' => 'River_Daugava', 'name' => 'River "Daugava"']);
    }
}
