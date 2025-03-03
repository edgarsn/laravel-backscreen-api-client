<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Live;

use Carbon\Carbon;
use Newman\LaravelBackscreenApiClient\Endpoints\Live\LiveList;
use Newman\LaravelBackscreenApiClient\Endpoints\Live\LiveList\OrderByEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Live\LiveList\PeriodEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Live\LiveList\ReturnEnum;
use Newman\LaravelBackscreenApiClient\EndpointSupport\Enums\OrderDirectionEnum;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class LiveListTest extends TestCase
{
    public function test_without_parameters(): void
    {
        $this->makeBasicAuthEndpointTest(new LiveList);
    }

    public function test_with_created_from(): void
    {
        $endpoint = new LiveList;

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

    public function test_with_created_period(): void
    {
        $endpoint = new LiveList;

        $endpoint->createdPeriod(PeriodEnum::LAST_HOUR);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'created_period' => 'last hour',
        ]);
    }

    public function test_with_created_to(): void
    {
        $endpoint = new LiveList;

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

    public function test_with_id(): void
    {
        $endpoint = new LiveList;

        // string
        $endpoint->id('1,2,3');

        $this->makeBasicAuthEndpointTest($endpoint, [
            'id' => '1,2,3',
        ]);

        // int
        $endpoint->id(1);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'id' => 1,
        ]);

        // array
        $endpoint->id([1, 2, 3]);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'id' => [1, 2, 3],
        ]);
    }

    public function test_with_id_from(): void
    {
        $endpoint = new LiveList;

        $endpoint->idFrom(1);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'id_from' => 1,
        ]);
    }

    public function test_with_id_to(): void
    {
        $endpoint = new LiveList;

        $endpoint->idTo(1);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'id_to' => 1,
        ]);
    }

    public function test_with_images_fallback(): void
    {
        $endpoint = new LiveList;

        $endpoint->imagesFallback(false);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'images_fallback' => 0,
        ]);
    }

    public function test_with_limit(): void
    {
        $endpoint = new LiveList;

        $endpoint->limit(10);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'limit' => 10,
        ]);
    }

    public function test_with_name(): void
    {
        $endpoint = new LiveList;

        $endpoint->name('name');

        $this->makeBasicAuthEndpointTest($endpoint, [
            'name' => 'name',
        ]);
    }

    public function test_with_offset(): void
    {
        $endpoint = new LiveList;

        $endpoint->offset(10);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'offset' => 10,
        ]);
    }

    public function test_with_order_by(): void
    {
        $endpoint = new LiveList;

        $endpoint->orderBy(OrderByEnum::ID);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'order_by' => 'id',
        ]);
    }

    public function test_with_order_direction(): void
    {
        $endpoint = new LiveList;

        $endpoint->orderDir(OrderDirectionEnum::DESC);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'order_dir' => OrderDirectionEnum::DESC->value,
        ]);
    }

    public function test_with_return(): void
    {
        $endpoint = new LiveList;

        $endpoint->return(ReturnEnum::CATEGORY);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'return' => ReturnEnum::CATEGORY->value,
        ]);

        $endpoint->return([ReturnEnum::CATEGORY, ReturnEnum::PUBLISH]);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'return' => [ReturnEnum::CATEGORY->value, ReturnEnum::PUBLISH->value],
        ]);
    }

    public function test_with_updated_from(): void
    {
        $endpoint = new LiveList;

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

    public function test_with_updated_period(): void
    {
        $endpoint = new LiveList;

        $endpoint->updatedPeriod(PeriodEnum::LAST_HOUR);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'updated_period' => 'last hour',
        ]);
    }

    public function test_with_updated_to(): void
    {
        $endpoint = new LiveList;

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
}
