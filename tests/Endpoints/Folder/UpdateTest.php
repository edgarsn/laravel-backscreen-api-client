<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder;

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
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Update;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class UpdateTest extends TestCase
{
    public function test_with_required_arguments(): void
    {
        $this->makeBasicAuthEndpointTest(new Update(123, TypeEnum::MEDIA), [], [
            'id' => 123,
            'type' => 'media',
        ]);
    }

    public function test_with_name(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);
        $endpoint->name('New Name');

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
            'name' => 'New Name',
        ]);
    }

    public function test_with_parent_id(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);
        $endpoint->parentId(0);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
            'parent_id' => 0,
        ]);
    }

    public function test_with_parent_id_invalid(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('parent_id must be >= 0');

        $endpoint->parentId(-1);
    }

    public function test_with_inherit_parent(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);
        $endpoint->inheritParent(0);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
            'inherit_parent' => 0,
        ]);
    }

    public function test_with_inherit_parent_invalid(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('inherit_parent must be 0 or 1');

        $endpoint->inheritParent(2);
    }

    public function test_with_priority(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);
        $endpoint->priority(-5);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
            'priority' => -5,
        ]);
    }

    public function test_with_priority_invalid(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('priority must be between -5 and 5');

        $endpoint->priority(-6);
    }

    public function test_with_embed(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);

        $embed = new Embed;
        $embed->posterFromThumbnail(1)->adId(0);

        $endpoint->embed($embed);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
            'embed' => [
                'poster_from_thumbnail' => 1,
                'ad_id' => 0,
            ],
        ]);
    }

    public function test_with_empty_embed(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);
        $endpoint->embed(new Embed);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
        ]);
    }

    public function test_with_security(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);

        $security = new Security;
        $security->encryptionMethod(EncryptionMethodEnum::DRM)->useToken(1);

        $endpoint->security($security);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
            'security' => [
                'encryption_method' => 'drm',
                'use_token' => 1,
            ],
        ]);
    }

    public function test_with_empty_security(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);
        $endpoint->security(new Security);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
        ]);
    }

    public function test_with_transcoding(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);

        $transcoding = new Transcoding;
        $transcoding->presetId(5)->subtitleStripHtml(1);

        $endpoint->transcoding($transcoding);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
            'transcoding' => [
                'preset_id' => 5,
                'subtitle_strip_html' => 1,
            ],
        ]);
    }

    public function test_with_empty_transcoding(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);
        $endpoint->transcoding(new Transcoding);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
        ]);
    }

    public function test_with_ingest(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);

        $ingest = new Ingest;
        $ingest->useTarManifest(1)->tarManifestFile('manifest.json');

        $endpoint->ingest($ingest);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
            'ingest' => [
                'use_tar_manifest' => 1,
                'tar_manifest_file' => 'manifest.json',
            ],
        ]);
    }

    public function test_with_empty_ingest(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);
        $endpoint->ingest(new Ingest);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
        ]);
    }

    public function test_with_external_uploads(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);

        $externalUploads = new ExternalUploads;
        $externalUploads->uploadAutomatically(0);

        $endpoint->externalUploads($externalUploads);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
            'external_uploads' => [
                'upload_automatically' => 0,
            ],
        ]);
    }

    public function test_with_empty_external_uploads(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);
        $endpoint->externalUploads(new ExternalUploads);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
        ]);
    }

    public function test_with_language(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);

        $language = new Language;
        $language->default('lv');

        $endpoint->language($language);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
            'language' => [
                'default' => 'lv',
            ],
        ]);
    }

    public function test_with_empty_language(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);
        $endpoint->language(new Language);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
        ]);
    }

    public function test_with_multi_audio(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);

        $group = new MultiAudioGroup;
        $group->id(2)->lang('lav');

        $multiAudio = new MultiAudio;
        $multiAudio->groups([$group]);

        $endpoint->multiAudio($multiAudio);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
            'multi_audio' => [
                'groups' => [
                    [
                        'id' => 2,
                        'lang' => 'lav',
                    ],
                ],
            ],
        ]);
    }

    public function test_with_empty_multi_audio(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);
        $endpoint->multiAudio(new MultiAudio);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
        ]);
    }

    public function test_with_availability(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);

        $availability = new Availability;
        $availability->published(0)->availableHours(48);

        $endpoint->availability($availability);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
            'availability' => [
                'published' => 0,
                'available_hours' => 48,
            ],
        ]);
    }

    public function test_with_empty_availability(): void
    {
        $endpoint = new Update(123, TypeEnum::MEDIA);
        $endpoint->availability(new Availability);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'type' => 'media',
        ]);
    }
}
