<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Media;

use Carbon\Carbon;
use Newman\LaravelTmsApiClient\Endpoints\Media\MediaList;
use Newman\LaravelTmsApiClient\EndpointSupport\Enums\OrderDirectionEnum;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class MediaListTest extends TestCase
{
    public function test_without_parameters(): void
    {
        $this->makeBasicAuthEndpointTest(new MediaList);
    }

    public function test_with_ids(): void
    {
        $endpoint = new MediaList;

        $endpoint->ids([1, 2]);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'id' => [1, 2],
        ]);
    }

    public function test_with_asset_ids(): void
    {
        $endpoint = new MediaList;

        $endpoint->assetIds(['99_abc', '10_def']);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'asset_id' => ['99_abc', '10_def'],
        ]);
    }

    public function test_with_category_ids(): void
    {
        $endpoint = new MediaList;

        $endpoint->categoryIds([1, 2]);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'cat_id' => [1, 2],
        ]);
    }

    public function test_with_created_from(): void
    {
        $endpoint = new MediaList;

        // unix
        $endpoint->createdFrom(1674135633);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'created_from' => 1674135633,
        ]);

        // string
        $endpoint->createdFrom('2023-01-19 15:41:43');

        $this->makeBasicAuthEndpointTest($endpoint, [
            'created_from' => '2023-01-19 15:41:43',
        ]);

        // Carbon
        $endpoint->createdFrom(Carbon::create(2023, 1, 19, 15, 41, 43));

        $this->makeBasicAuthEndpointTest($endpoint, [
            'created_from' => '2023-01-19 15:41:43',
        ]);
    }

    public function test_with_created_to(): void
    {
        $endpoint = new MediaList;

        // unix
        $endpoint->createdTo(1674135633);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'created_to' => 1674135633,
        ]);

        // string
        $endpoint->createdTo('2023-01-19 15:41:43');

        $this->makeBasicAuthEndpointTest($endpoint, [
            'created_to' => '2023-01-19 15:41:43',
        ]);

        // Carbon
        $endpoint->createdTo(Carbon::create(2023, 1, 19, 15, 41, 43));

        $this->makeBasicAuthEndpointTest($endpoint, [
            'created_to' => '2023-01-19 15:41:43',
        ]);
    }

    public function test_with_updated_from(): void
    {
        $endpoint = new MediaList;

        // unix
        $endpoint->updatedFrom(1674135633);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'updated_from' => 1674135633,
        ]);

        // string
        $endpoint->updatedFrom('2023-01-19 15:41:43');

        $this->makeBasicAuthEndpointTest($endpoint, [
            'updated_from' => '2023-01-19 15:41:43',
        ]);

        // Carbon
        $endpoint->updatedFrom(Carbon::create(2023, 1, 19, 15, 41, 43));

        $this->makeBasicAuthEndpointTest($endpoint, [
            'updated_from' => '2023-01-19 15:41:43',
        ]);
    }

    public function test_with_updated_to(): void
    {
        $endpoint = new MediaList;

        // unix
        $endpoint->updatedTo(1674135633);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'updated_to' => 1674135633,
        ]);

        // string
        $endpoint->updatedTo('2023-01-19 15:41:43');

        $this->makeBasicAuthEndpointTest($endpoint, [
            'updated_to' => '2023-01-19 15:41:43',
        ]);

        // Carbon
        $endpoint->updatedTo(Carbon::create(2023, 1, 19, 15, 41, 43));

        $this->makeBasicAuthEndpointTest($endpoint, [
            'updated_to' => '2023-01-19 15:41:43',
        ]);
    }

    public function test_with_published(): void
    {
        $endpoint = new MediaList;

        $endpoint->published(true);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'published' => 1,
        ]);

        $endpoint->published(false);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'published' => 0,
        ]);
    }

    public function test_with_publisher_status(): void
    {
        $endpoint = new MediaList;

        $endpoint->publisherStatus(MediaList\PublisherStatusEnum::SCHEDULED);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'publisher_status' => MediaList\PublisherStatusEnum::SCHEDULED->value,
        ]);
    }

    public function test_with_only_available(): void
    {
        $endpoint = new MediaList;

        $endpoint->onlyAvailable(true);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'only_available' => 1,
        ]);

        $endpoint->onlyAvailable(false);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'only_available' => 0,
        ]);
    }

    public function test_with_search(): void
    {
        $endpoint = new MediaList;

        $endpoint->search('lorem ipsum');

        $this->makeBasicAuthEndpointTest($endpoint, [
            'search' => 'lorem ipsum',
        ]);
    }

    public function test_with_status(): void
    {
        $endpoint = new MediaList;

        $endpoint->status(MediaList\StatusEnum::APPROVED);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'status' => [MediaList\StatusEnum::APPROVED->value],
        ]);

        $endpoint->status([MediaList\StatusEnum::INGESTED, MediaList\StatusEnum::NEW]);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'status' => [MediaList\StatusEnum::INGESTED->value, MediaList\StatusEnum::NEW->value],
        ]);
    }

    public function test_with_tags(): void
    {
        $endpoint = new MediaList;

        $endpoint->tags(['lorem', 'ipsum']);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'tags' => ['lorem', 'ipsum'],
        ]);
    }

    public function test_with_limit(): void
    {
        $endpoint = new MediaList;

        $endpoint->limit(5);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'limit' => 5,
        ]);
    }

    public function test_with_limit_out_of_bounds_exception(): void
    {
        $endpoint = new MediaList;

        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage('Limit must be between 1 and 50.');

        $endpoint->limit(1000);
    }

    public function test_with_offset(): void
    {
        $endpoint = new MediaList;

        $endpoint->offset(5);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'offset' => 5,
        ]);
    }

    public function test_with_order_by(): void
    {
        $endpoint = new MediaList;

        $endpoint->orderBy(MediaList\OrderByEnum::CREATED_AT);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'order_by' => MediaList\OrderByEnum::CREATED_AT->value,
        ]);
    }

    public function test_with_order_dir(): void
    {
        $endpoint = new MediaList;

        $endpoint->orderDir(OrderDirectionEnum::ASC);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'order_dir' => OrderDirectionEnum::ASC->value,
        ]);
    }

    public function test_with_images_fallback(): void
    {
        $endpoint = new MediaList;

        $endpoint->imagesFallback(true);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'images_fallback' => 1,
        ]);

        $endpoint->imagesFallback(false);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'images_fallback' => 0,
        ]);
    }

    public function test_with_return(): void
    {
        $endpoint = new MediaList;

        $endpoint->return(['actions', 'tech_status']);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'return' => ['actions', 'tech_status'],
        ]);
    }
}
