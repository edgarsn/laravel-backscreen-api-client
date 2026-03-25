<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Availability;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Embed;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\EncryptionMethodEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\ProtocolEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Files;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Images;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Player;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Presentation;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\PresentationConfig;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Security;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Tags;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\TranscodeInfo;
use Newman\LaravelBackscreenApiClient\EndpointSupport\Images as LegacyImages;
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

    public function test_with_transcode_info(): void
    {
        $endpoint = new Create('123');

        $info = new TranscodeInfo;
        $info->dvbLngOrder('lv,en')->presetId(5);

        $endpoint->transcodeInfo($info);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'transcode_info' => [
                'dvb_lng_order' => 'lv,en',
                'preset_id' => 5,
            ],
        ]);
    }

    public function test_with_empty_transcode_info(): void
    {
        $endpoint = new Create('123');

        $endpoint->transcodeInfo(new TranscodeInfo);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
        ]);
    }

    public function test_with_images(): void
    {
        $endpoint = new Create('123');

        $encodedImage = 'data:image/png;base64,'.base64_encode('imagebase64_1');

        $images = new Images;
        $images->thumbnail($encodedImage);

        $endpoint->images($images);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'images' => ['thumbnail' => $encodedImage],
        ]);
    }

    public function test_with_legacy_images(): void
    {
        $endpoint = new Create('123');

        $encodedImage = 'data:image/png;base64,'.base64_encode('imagebase64_1');

        $images = new LegacyImages;
        $images->thumbnail($encodedImage)->placeholder($encodedImage);

        $endpoint->images($images);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'images' => ['thumbnail' => $encodedImage, 'placeholder' => $encodedImage],
        ]);
    }

    public function test_with_empty_images(): void
    {
        $endpoint = new Create('123');
        $endpoint->images(new Images);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
        ]);
    }

    public function test_with_embed(): void
    {
        $endpoint = new Create('123');

        $embed = new Embed;
        $embed->protocol(ProtocolEnum::HTTPS)->autoplay(1);

        $endpoint->embed($embed);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'embed' => [
                'protocol' => 'https',
                'autoplay' => 1,
            ],
        ]);
    }

    public function test_with_empty_embed(): void
    {
        $endpoint = new Create('123');
        $endpoint->embed(new Embed);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
        ]);
    }

    public function test_with_presentation(): void
    {
        $endpoint = new Create('123');

        $config = new PresentationConfig;
        $config->fileId(99);

        $presentation = new Presentation;
        $presentation->mode(1)->config($config);

        $endpoint->presentation($presentation);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'presentation' => [
                'mode' => 1,
                'config' => ['file_id' => 99],
            ],
        ]);
    }

    public function test_with_empty_presentation(): void
    {
        $endpoint = new Create('123');
        $endpoint->presentation(new Presentation);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
        ]);
    }

    public function test_with_player(): void
    {
        $endpoint = new Create('123');

        $player = new Player;
        $player->logoRedirect('https://example.com')->preloadContent(1);

        $endpoint->player($player);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'player' => [
                'logo_redirect' => 'https://example.com',
                'preload_content' => 1,
            ],
        ]);
    }

    public function test_with_empty_player(): void
    {
        $endpoint = new Create('123');
        $endpoint->player(new Player);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
        ]);
    }

    public function test_with_security(): void
    {
        $endpoint = new Create('123');

        $security = new Security;
        $security->encryptionMethod(EncryptionMethodEnum::AES)->useToken(1);

        $endpoint->security($security);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'security' => [
                'encryption_method' => 'aes',
                'use_token' => 1,
            ],
        ]);
    }

    public function test_with_empty_security(): void
    {
        $endpoint = new Create('123');
        $endpoint->security(new Security);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
        ]);
    }

    public function test_with_availability(): void
    {
        $endpoint = new Create('123');

        $availability = new Availability;
        $availability->published(1)->expireTime('2026-12-31 23:59:59');

        $endpoint->availability($availability);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
            'availability' => [
                'published' => 1,
                'expire_time' => '2026-12-31 23:59:59',
            ],
        ]);
    }

    public function test_with_empty_availability(): void
    {
        $endpoint = new Create('123');
        $endpoint->availability(new Availability);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'asset_id' => '123',
        ]);
    }
}
