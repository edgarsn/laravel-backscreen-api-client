<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Availability;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Embed;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Enums\EncryptionMethodEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\ExternalUploads;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Ingest;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Language;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\MultiAudio;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\MultiAudioGroup;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Security;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Transcoding;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\FolderList\TypeEnum;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class CreateTest extends TestCase
{
    public function test_with_required_arguments(): void
    {
        $this->makeBasicAuthEndpointTest(new Create(TypeEnum::MEDIA, 'Test Folder'), [], [
            'type' => 'media',
            'name' => 'Test Folder',
        ]);
    }

    public function test_with_parent_id(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');
        $endpoint->parentId(0);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
            'parent_id' => 0,
        ]);
    }

    public function test_with_parent_id_invalid(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('parent_id must be >= 0');

        $endpoint->parentId(-1);
    }

    public function test_with_inherit_parent(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');
        $endpoint->inheritParent(1);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
            'inherit_parent' => 1,
        ]);
    }

    public function test_with_inherit_parent_invalid(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('inherit_parent must be 0 or 1');

        $endpoint->inheritParent(2);
    }

    public function test_with_priority(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');
        $endpoint->priority(5);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
            'priority' => 5,
        ]);
    }

    public function test_with_priority_invalid(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('priority must be between -5 and 5');

        $endpoint->priority(6);
    }

    public function test_with_create_ftp_folder(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');
        $endpoint->createFtpFolder(1);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
            'create_ftp_folder' => 1,
        ]);
    }

    public function test_with_create_ftp_folder_invalid(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('create_ftp_folder must be 0 or 1');

        $endpoint->createFtpFolder(2);
    }

    public function test_with_embed(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');

        $embed = new Embed;
        $embed->enablePublic(1)->playerId(5);

        $endpoint->embed($embed);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
            'embed' => [
                'enable_public' => 1,
                'player_id' => 5,
            ],
        ]);
    }

    public function test_with_empty_embed(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');
        $endpoint->embed(new Embed);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
        ]);
    }

    public function test_with_security(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');

        $security = new Security;
        $security->encryptionMethod(EncryptionMethodEnum::AES)->useToken(1);

        $endpoint->security($security);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
            'security' => [
                'encryption_method' => 'aes',
                'use_token' => 1,
            ],
        ]);
    }

    public function test_with_empty_security(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');
        $endpoint->security(new Security);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
        ]);
    }

    public function test_with_transcoding(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');

        $transcoding = new Transcoding;
        $transcoding->presetId(10)->reTrancode(1);

        $endpoint->transcoding($transcoding);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
            'transcoding' => [
                'preset_id' => 10,
                're_transcode' => 1,
            ],
        ]);
    }

    public function test_with_empty_transcoding(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');
        $endpoint->transcoding(new Transcoding);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
        ]);
    }

    public function test_with_ingest(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');

        $ingest = new Ingest;
        $ingest->updateAssetName(1)->subtitleOffset('00:00:10');

        $endpoint->ingest($ingest);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
            'ingest' => [
                'update_asset_name' => 1,
                'subtitle_offset' => '00:00:10',
            ],
        ]);
    }

    public function test_with_empty_ingest(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');
        $endpoint->ingest(new Ingest);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
        ]);
    }

    public function test_with_external_uploads(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');

        $externalUploads = new ExternalUploads;
        $externalUploads->uploadAutomatically(1);

        $endpoint->externalUploads($externalUploads);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
            'external_uploads' => [
                'upload_automatically' => 1,
            ],
        ]);
    }

    public function test_with_empty_external_uploads(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');
        $endpoint->externalUploads(new ExternalUploads);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
        ]);
    }

    public function test_with_language(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');

        $language = new Language;
        $language->default('en')->order('en,lv');

        $endpoint->language($language);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
            'language' => [
                'default' => 'en',
                'order' => 'en,lv',
            ],
        ]);
    }

    public function test_with_empty_language(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');
        $endpoint->language(new Language);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
        ]);
    }

    public function test_with_multi_audio(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');

        $group = new MultiAudioGroup;
        $group->id(1)->lang('eng')->name('English');

        $multiAudio = new MultiAudio;
        $multiAudio->groups([$group]);

        $endpoint->multiAudio($multiAudio);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
            'multi_audio' => [
                'groups' => [
                    [
                        'id' => 1,
                        'lang' => 'eng',
                        'name' => 'English',
                    ],
                ],
            ],
        ]);
    }

    public function test_with_empty_multi_audio(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');
        $endpoint->multiAudio(new MultiAudio);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
        ]);
    }

    public function test_with_availability(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');

        $availability = new Availability;
        $availability->published(1)->expireHours(24);

        $endpoint->availability($availability);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
            'availability' => [
                'published' => 1,
                'expire_hours' => 24,
            ],
        ]);
    }

    public function test_with_empty_availability(): void
    {
        $endpoint = new Create(TypeEnum::MEDIA, 'Test Folder');
        $endpoint->availability(new Availability);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'name' => 'Test Folder',
        ]);
    }
}
