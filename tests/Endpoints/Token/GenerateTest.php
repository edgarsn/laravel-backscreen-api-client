<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Token;

use Carbon\Carbon;
use Newman\LaravelTmsApiClient\Endpoints\Token\Generate;
use Newman\LaravelTmsApiClient\Endpoints\Token\Generate\SubitemTypeEnum;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class GenerateTest extends TestCase
{
    public function test_with_required_arguments(): void
    {
        $this->makeBasicAuthEndpointTest(new Generate(1, Generate\ItemTypeEnum::MEDIA), [
            'item_id' => 1,
            'item_type' => Generate\ItemTypeEnum::MEDIA->value,
        ]);
    }

    public function test_with_allowedCountries(): void
    {
        $endpoint = new Generate(1, Generate\ItemTypeEnum::MEDIA);

        $endpoint->allowedCountries(['lv', 'lt']);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'item_id' => 1,
            'item_type' => Generate\ItemTypeEnum::MEDIA->value,
            'allowed_countries' => 'lv,lt',
        ]);
    }

    public function test_with_allowedIp(): void
    {
        $endpoint = new Generate(1, Generate\ItemTypeEnum::MEDIA);

        $endpoint->allowedIp('85.1.1.1');

        $this->makeBasicAuthEndpointTest($endpoint, [
            'item_id' => 1,
            'item_type' => Generate\ItemTypeEnum::MEDIA->value,
            'allowed_ip' => '85.1.1.1',
        ]);
    }

    public function test_with_expireTime(): void
    {
        $endpoint = new Generate(1, Generate\ItemTypeEnum::MEDIA);

        // unix
        $endpoint->expireTime(1674135633);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'item_id' => 1,
            'item_type' => Generate\ItemTypeEnum::MEDIA->value,
            'expire_time' => 1674135633,
        ]);

        // string
        $endpoint->expireTime('2023-01-19 15:41:43');

        $this->makeBasicAuthEndpointTest($endpoint, [
            'item_id' => 1,
            'item_type' => Generate\ItemTypeEnum::MEDIA->value,
            'expire_time' => '2023-01-19 15:41:43',
        ]);

        // carbon
        $endpoint->expireTime(Carbon::create(2023, 1, 19, 15, 41, 43));

        $this->makeBasicAuthEndpointTest($endpoint, [
            'item_id' => 1,
            'item_type' => Generate\ItemTypeEnum::MEDIA->value,
            'expire_time' => '2023-01-19 15:41:43',
        ]);
    }

    public function test_with_subitemId(): void
    {
        $endpoint = new Generate(1, Generate\ItemTypeEnum::MEDIA);

        $endpoint->subitemId(830);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'item_id' => 1,
            'item_type' => Generate\ItemTypeEnum::MEDIA->value,
            'subitem_id' => 830,
        ]);
    }

    public function test_with_subitemType(): void
    {
        $endpoint = new Generate(1, Generate\ItemTypeEnum::MEDIA);

        $endpoint->subitemType(SubitemTypeEnum::PLAYBACK_HLS);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'item_id' => 1,
            'item_type' => Generate\ItemTypeEnum::MEDIA->value,
            'subitem_type' => SubitemTypeEnum::PLAYBACK_HLS->value,
        ]);
    }
}
