<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Media;

use Newman\LaravelTmsApiClient\Endpoints\Media\Update;
use Newman\LaravelTmsApiClient\Endpoints\Media\Update\ByAssetId;
use Newman\LaravelTmsApiClient\Endpoints\Media\Update\ByMediaId;
use Newman\LaravelTmsApiClient\EndpointSupport\Callback;
use Newman\LaravelTmsApiClient\EndpointSupport\Enums\CallbackHttpMethodEnum;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class UpdateTest extends TestCase
{
    public function test_with_required_arguments(): void
    {
        $this->makeBasicAuthEndpointTest(new Update(new ByMediaId(1234)), [], [
            'id' => 1234,
        ]);

        $this->makeBasicAuthEndpointTest(new Update(new ByAssetId('99_asset')), [], [
            'asset_id' => '99_asset',
        ]);
    }

    public function test_with_name(): void
    {
        $endpoint = new Update(new ByMediaId(1234));

        $endpoint->name('Lorem');

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'name' => 'Lorem',
        ]);
    }

    public function test_with_description(): void
    {
        $endpoint = new Update(new ByMediaId(1234));

        $endpoint->description('Lorem Ipsum is simply dummy text');

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'description' => 'Lorem Ipsum is simply dummy text',
        ]);
    }

    public function test_with_images(): void
    {
        $endpoint = new Update(new ByMediaId(1234));

        $images = new Update\Images();
        $images->thumbnail('aW1hZ2ViYXNlNjRfMQ==');

        $endpoint->images($images);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'images' => [
                'thumbnail' => 'aW1hZ2ViYXNlNjRfMQ==',
            ],
        ]);

        $endpoint->images(new Update\Images());

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
        ]);
    }

    public function test_with_callback(): void
    {
        $endpoint = new Update(new ByMediaId(1234));

        $endpoint->callback([
            new Callback('https://mysite.com', CallbackHttpMethodEnum::POST)
        ]);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'callback' => [
                [
                    'url' => 'https://mysite.com',
                    'method' => CallbackHttpMethodEnum::POST->value,
                ]
            ],
        ]);
    }
}
