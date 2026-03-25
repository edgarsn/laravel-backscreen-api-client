<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Availability;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\EncryptionMethodEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\ProtocolEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Files;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Player;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Presentation;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Security;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\TranscodeInfo;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\ByAssetId;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\ByMediaId;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\Embed;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\Enums\MaterialChangeTypeEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\Images;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\MaterialChange;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\Tags;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\UpdateManifest;
use Newman\LaravelBackscreenApiClient\EndpointSupport\Callback;
use Newman\LaravelBackscreenApiClient\EndpointSupport\Enums\CallbackHttpMethodEnum;
use Newman\LaravelBackscreenApiClient\EndpointSupport\Images as LegacyImages;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

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

        $images = new Images;
        $images->thumbnail('data:image/png;base64,aW1hZ2ViYXNlNjRfMQ==');

        $endpoint->images($images);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'images' => [
                'thumbnail' => 'data:image/png;base64,aW1hZ2ViYXNlNjRfMQ==',
            ],
        ]);

        $endpoint->images(new Images);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
        ]);
    }

    public function test_with_callback(): void
    {
        $endpoint = new Update(new ByMediaId(1234));

        $endpoint->callback([
            new Callback('https://mysite.com', CallbackHttpMethodEnum::POST),
        ]);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'callback' => [
                [
                    'url' => 'https://mysite.com',
                    'method' => CallbackHttpMethodEnum::POST->value,
                ],
            ],
        ]);
    }

    public function test_with_cat_id(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $endpoint->catId(99);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'cat_id' => 99,
        ]);
    }

    public function test_with_pg_rating(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $endpoint->pgRating('PG-13');

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'pg_rating' => 'PG-13',
        ]);
    }

    public function test_with_auto_transcode(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $endpoint->autoTranscode(1);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'auto_transcode' => 1,
        ]);
    }

    public function test_with_embed_player_id(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $endpoint->embedPlayerId(456);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'embed_player_id' => 456,
        ]);
    }

    public function test_with_embed_player_id_inherit(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $endpoint->embedPlayerId(-1);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'embed_player_id' => -1,
        ]);
    }

    public function test_with_embed_player_id_invalid(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('embed_player_id must be >= -1');
        $endpoint->embedPlayerId(-2);
    }

    public function test_with_embed_ad_id(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $endpoint->embedAdId(789);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'embed_ad_id' => 789,
        ]);
    }

    public function test_with_embed_ad_id_invalid(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('embed_ad_id must be >= -1');
        $endpoint->embedAdId(-2);
    }

    public function test_with_embed_protection_id(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $endpoint->embedProtectionId(987);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'embed_protection_id' => 987,
        ]);
    }

    public function test_with_embed_protection_id_invalid(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('embed_protection_id must be >= -1');
        $endpoint->embedProtectionId(-2);
    }

    public function test_with_transcode_info(): void
    {
        $endpoint = new Update(new ByMediaId(1234));

        $info = new TranscodeInfo;
        $info->presetId(10);

        $endpoint->transcodeInfo($info);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'transcode_info' => ['preset_id' => 10],
        ]);
    }

    public function test_with_empty_transcode_info(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $endpoint->transcodeInfo(new TranscodeInfo);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
        ]);
    }

    public function test_with_legacy_images(): void
    {
        $endpoint = new Update(new ByMediaId(1234));

        $encodedImage = 'data:image/png;base64,'.base64_encode('imagebase64_1');

        $legacyImages = new LegacyImages;
        $legacyImages->thumbnail($encodedImage)->placeholder($encodedImage);

        $endpoint->images($legacyImages);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'images' => ['thumbnail' => $encodedImage, 'placeholder' => $encodedImage],
        ]);
    }

    public function test_with_embed(): void
    {
        $endpoint = new Update(new ByMediaId(1234));

        $embed = new Embed;
        $embed->protocol(ProtocolEnum::HTTPS)->mute(1);

        $endpoint->embed($embed);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'embed' => [
                'protocol' => 'https',
                'mute' => 1,
            ],
        ]);
    }

    public function test_with_empty_embed(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $endpoint->embed(new Embed);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
        ]);
    }

    public function test_with_presentation(): void
    {
        $endpoint = new Update(new ByMediaId(1234));

        $presentation = new Presentation;
        $presentation->mode(0);

        $endpoint->presentation($presentation);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'presentation' => ['mode' => 0],
        ]);
    }

    public function test_with_player(): void
    {
        $endpoint = new Update(new ByMediaId(1234));

        $player = new Player;
        $player->preloadContent(0);

        $endpoint->player($player);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'player' => ['preload_content' => 0],
        ]);
    }

    public function test_with_files(): void
    {
        $endpoint = new Update(new ByMediaId(1234));

        $file = new Files;
        $file->url('https://mysite.com')->lang('lv');

        $endpoint->files([$file]);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'files' => [
                ['url' => 'https://mysite.com', 'lang' => 'lv'],
            ],
        ]);
    }

    public function test_with_empty_files(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $endpoint->files([new Files]);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
        ]);
    }

    public function test_with_security(): void
    {
        $endpoint = new Update(new ByMediaId(1234));

        $security = new Security;
        $security->encryptionMethod(EncryptionMethodEnum::DRM);

        $endpoint->security($security);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'security' => ['encryption_method' => 'drm'],
        ]);
    }

    public function test_with_availability(): void
    {
        $endpoint = new Update(new ByMediaId(1234));

        $availability = new Availability;
        $availability->published(0);

        $endpoint->availability($availability);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'availability' => ['published' => 0],
        ]);
    }

    public function test_with_metadata(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $endpoint->metadata(['key' => 'value']);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'metadata' => ['key' => 'value'],
        ]);
    }

    public function test_with_timezone(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $endpoint->timezone('Europe/Riga');

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'timezone' => 'Europe/Riga',
        ]);
    }

    public function test_with_tags(): void
    {
        $endpoint = new Update(new ByMediaId(1234));

        $tags = new Tags;
        $tags->set(['tag1'])->add(['tag2'])->remove(['tag3']);

        $endpoint->tags($tags);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'tags' => [
                'remove' => ['tag3'],
                'set' => ['tag1'],
                'add' => ['tag2'],
            ],
        ]);
    }

    public function test_with_empty_tags(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $endpoint->tags(new Tags);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
        ]);
    }

    public function test_with_update_manifests(): void
    {
        $endpoint = new Update(new ByMediaId(1234));

        $change = new MaterialChange;
        $change->type(MaterialChangeTypeEnum::THUMBNAIL)->timestamp(1674135633);

        $manifest = new UpdateManifest;
        $manifest->id(5)->startAt(0)->endAt(120)->materialChange($change);

        $endpoint->updateManifests([$manifest]);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
            'update_manifests' => [
                [
                    'id' => 5,
                    'start_at' => 0,
                    'end_at' => 120,
                    'material_change' => [
                        'type' => 'thumbnail',
                        'timestamp' => 1674135633,
                    ],
                ],
            ],
        ]);
    }

    public function test_with_empty_update_manifests(): void
    {
        $endpoint = new Update(new ByMediaId(1234));
        $endpoint->updateManifests([new UpdateManifest]);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1234,
        ]);
    }
}
