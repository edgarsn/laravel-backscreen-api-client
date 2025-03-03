<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Manifest;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Manifest\List\OrderByEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Manifest\ManifestList;
use Newman\LaravelBackscreenApiClient\EndpointSupport\Enums\OrderDirectionEnum;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class ManifestListTest extends TestCase
{
    public function test(): void
    {
        $this->makeBasicAuthEndpointTest(new ManifestList);
    }

    public function test_with_ids(): void
    {
        $endpoint = new ManifestList;

        $endpoint->ids([1, 2]);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'id' => [1, 2],
        ]);
    }

    public function test_with_limit(): void
    {
        $endpoint = new ManifestList;

        $endpoint->limit(5);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'limit' => 5,
        ]);
    }

    public function test_with_media_ids(): void
    {
        $endpoint = new ManifestList;

        $endpoint->mediaIds([123, 345]);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'media_id' => [123, 345],
        ]);
    }

    public function test_with_offset(): void
    {
        $endpoint = new ManifestList;

        $endpoint->offset(15);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'offset' => 15,
        ]);
    }

    public function test_with_order_by(): void
    {
        $endpoint = new ManifestList;

        $endpoint->orderBy(OrderByEnum::MEDIA_ID);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'order_by' => OrderByEnum::MEDIA_ID->value,
        ]);
    }

    public function test_with_order_dir(): void
    {
        $endpoint = new ManifestList;

        $endpoint->orderDir(OrderDirectionEnum::ASC);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'order_dir' => OrderDirectionEnum::ASC->value,
        ]);
    }
}
