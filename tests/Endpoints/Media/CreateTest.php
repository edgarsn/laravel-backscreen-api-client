<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Files;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Tags;
use Newman\LaravelBackscreenApiClient\EndpointSupport\Callback;
use Newman\LaravelBackscreenApiClient\EndpointSupport\Enums\CallbackHttpMethodEnum;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class CreateTest extends TestCase
{
    public function test_with_required_arguments(): void
    {
        $this->makeBearerAuthEndpointTest(new Create('123'), [], [
            'asset_id' => '123',
        ]);
    }

    public function test_with_asset_id(): void
    {
        $endpoint = new Create('123');

        $endpoint->assetId('1234');

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '1234',
        ]);
    }

    public function test_with_cat_id(): void
    {
        $endpoint = new Create('123');

        $endpoint->catId(1735);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'cat_id' => 1735,
        ]);
    }

    public function test_with_name(): void
    {
        $endpoint = new Create('123');

        $endpoint->name('Test Media');

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'name' => 'Test Media',
        ]);
    }

    public function test_with_description(): void
    {
        $endpoint = new Create('123');

        $endpoint->description('Test description');

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'description' => 'Test description',
        ]);
    }

    public function test_with_pg_rating(): void
    {
        $endpoint = new Create('123');

        $endpoint->pgRating('PG-13');

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'pg_rating' => 'PG-13',
        ]);
    }

    public function test_with_auto_transcode(): void
    {
        $endpoint = new Create('123');

        $endpoint->autoTranscode(1);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'auto_transcode' => 1,
        ]);
    }

    public function test_with_embed_player_id(): void
    {
        $endpoint = new Create('123');

        $endpoint->embedPlayerId(456);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'embed_player_id' => 456,
        ]);
    }

    public function test_with_embed_ad_id(): void
    {
        $endpoint = new Create('123');

        $endpoint->embedAdId(789);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'embed_ad_id' => 789,
        ]);
    }

    public function test_with_embed_protection_id(): void
    {
        $endpoint = new Create('123');

        $endpoint->embedProtectionId(987);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'embed_protection_id' => 987,
        ]);
    }

    public function test_with_metadata(): void
    {
        $endpoint = new Create('123');

        $endpoint->metadata(['key' => 'value']);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'metadata' => ['key' => 'value'],
        ]);
    }

    public function test_with_timezone(): void
    {
        $endpoint = new Create('123');

        $endpoint->timezone('Europe/Riga');

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'timezone' => 'Europe/Riga',
        ]);
    }

    public function test_with_files(): void
    {
        $endpoint = new Create('123');

        $files = new Files;
        $files->url('https://mysite.com');
        $files->username('username');
        $files->password('password');
        $files->bitrate(3000);
        $files->lang('lv');

        $endpoint->files([$files]);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'files' => [
                [
                    'url' => 'https://mysite.com',
                    'username' => 'username',
                    'password' => 'password',
                    'bitrate' => 3000,
                    'lang' => 'lv',
                ],
            ],
        ]);
    }

    public function test_with_empty_files(): void
    {
        $endpoint = new Create('123');

        $files = new Files;
        $endpoint->files([$files]);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
        ]);
    }

    public function test_with_tags(): void
    {
        $endpoint = new Create('123');

        $tags = new Tags;
        $tags->set(['tag1', 'tag2']);
        $tags->add(['tag3']);

        $endpoint->tags($tags);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'tags' => [
                'set' => ['tag1', 'tag2'],
                'add' => ['tag3'],
            ],
        ]);
    }

    public function test_with_empty_tags(): void
    {
        $endpoint = new Create('123');

        $tags = new Tags;
        $endpoint->tags($tags);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
        ]);
    }

    public function test_with_callback(): void
    {
        $endpoint = new Create('123');

        $endpoint->callback([
            new Callback('https://mysite.com', CallbackHttpMethodEnum::POST),
        ]);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'callback' => [
                [
                    'url' => 'https://mysite.com',
                    'method' => CallbackHttpMethodEnum::POST->value,
                ],
            ],
        ]);
    }
}
