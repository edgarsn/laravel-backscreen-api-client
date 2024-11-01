<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Live;

use Carbon\Carbon;
use Newman\LaravelTmsApiClient\Endpoints\Live\Update;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Availability;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Embed;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Enums\EncryptionMethodEnum;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Enums\ProtocolEnum;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Enums\TokenDurationEnum;
use Newman\LaravelTmsApiClient\EndpointSupport\Images;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Input\AudioLanguage;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Input\Input;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Input\Packager;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Publish;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Recording\EPG;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Recording\Nimbus;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Recording\Recording;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Security;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class UpdateTest extends TestCase
{
    public function test_without_parameters(): void
    {
        $this->makeBasicAuthEndpointTest(new Update(1), [], [
            'id' => 1,
        ]);
    }

    public function test_with_id(): void
    {
        $endpoint = new Update(1);
        $endpoint->id(2);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 2,
        ]);
    }

    public function test_with_name(): void
    {
        $endpoint = new Update(1);

        $endpoint->name('name');

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'name' => 'name',
        ]);
    }

    public function test_with_cat_id(): void
    {
        $endpoint = new Update(1);

        $endpoint->catId(1);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'cat_id' => 1,
        ]);
    }

    public function test_with_multi_languages(): void
    {
        $endpoint = new Update(1);

        $endpoint->multiLanguages(true);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'multi_languages' => 1,
        ]);
    }

    public function test_with_custom_origin(): void
    {
        $endpoint = new Update(1);

        $endpoint->customOrigin('custom_origin');

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'custom_origin' => 'custom_origin',
        ]);
    }

    public function test_with_publish(): void
    {
        $endpoint = new Update(1);

        $publish = new Publish();
        $publish->prefix('prefix');
        $endpoint->publish($publish);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'publish' => [
                'prefix' => 'prefix',
            ],
        ]);
    }

    public function test_with_empty_publish(): void
    {
        $endpoint = new Update(1);

        $publish = new Publish();
        $endpoint->publish($publish);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
        ]);
    }

    public function test_with_embed_player_id(): void
    {
        $endpoint = new Update(1);

        $endpoint->embedPlayerId(1);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'embed_player_id' => 1,
        ]);
    }

    public function test_with_embed_ad_id(): void
    {
        $endpoint = new Update(1);

        $endpoint->embedAdId(1);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'embed_ad_id' => 1,
        ]);
    }

    public function test_with_embed_protection_id(): void
    {
        $endpoint = new Update(1);

        $endpoint->embedProtectionId(1);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'embed_protection_id' => 1,
        ]);
    }

    public function test_with_embed(): void
    {
        $endpoint = new Update(1);

        $embed = new Embed();
        $embed->enablePublic(true);
        $embed->publicPassword('public_password');
        $embed->enablePreview(true);

        $endpoint->embed($embed);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'embed' => [
                'enable_public' => 1,
                'public_password' => 'public_password',
                'enable_preview' => 1,
            ]
        ]);
    }

    public function test_with_empty_embed(): void
    {
        $endpoint = new Update(1);

        $embed = new Embed();
        $endpoint->embed($embed);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
        ]);
    }

    public function test_with_security(): void
    {
        $endpoint = new Update(1);

        $security = new Security();
        $security->encryptionMethod(EncryptionMethodEnum::DRMAES);
        $security->useToken(true);
        $security->tokenDuration(TokenDurationEnum::DAY);

        $endpoint->security($security);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'security' => [
                'encryption_method' => EncryptionMethodEnum::DRMAES->value,
                'use_token' => 1,
                'token_duration' => TokenDurationEnum::DAY->value,
            ]
        ]);
    }

    public function test_with_empty_security(): void
    {
        $endpoint = new Update(1);

        $security = new Security();
        $endpoint->security($security);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
        ]);
    }

    public function test_with_recording(): void
    {
        $endpoint = new Update(1);

        $recording = new Recording();
        $recording->autoDelete(true);
        $recording->autoDeleteMedia(true);
        $recording->savePassed(true);
        $recording->deleteAfterHours(10);
        $recording->marginStartSeconds(10);
        $recording->marginEndSeconds(10);
        $recording->fileNamingPattern('file_naming_pattern');

        $nimbus = new Nimbus();
        $nimbus->syncInterval(1);
        $nimbus->channelId(1);
        $nimbus->manifestId(1);

        $epg = new EPG();
        $epg->hoursBefore(1);
        $epg->hoursAfter(1);
        $epg->round(1);

        $recording->nimbus($nimbus);
        $recording->epg($epg);
        $endpoint->recording($recording);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'recording' => [
                'auto_delete' => 1,
                'auto_delete_media' => 1,
                'save_passed' => 1,
                'delete_after_hours' => 10,
                'margin_start_seconds' => 10,
                'margin_end_seconds' => 10,
                'file_naming_pattern' => 'file_naming_pattern',
                'nimbus' => [
                    'sync_interval' => 1,
                    'channel_id' => 1,
                    'manifest_id' => 1,
                ],
                'epg' => [
                    'hours_before' => 1,
                    'hours_after' => 1,
                    'round' => 1,
                ],
            ]
        ]);
    }

    public function test_with_empty_recording(): void
    {
        $endpoint = new Update(1);

        $recording = new Recording();
        $endpoint->recording($recording);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
        ]);
    }

    public function test_with_images(): void
    {
        $endpoint = new Update(1);

        $images = new Images();
        $images->thumbnail('data:image/png;base64,' . base64_encode('thumbnail'));
        $images->placeholder('data:image/png;base64,' . base64_encode('placeholder'));
        $images->playbutton('data:image/png;base64,' . base64_encode('playbutton'));
        $images->logo('data:image/png;base64,' . base64_encode('logo'));

        $endpoint->images($images);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'images' => [
                'thumbnail' => 'data:image/png;base64,' . base64_encode('thumbnail'),
                'placeholder' => 'data:image/png;base64,' . base64_encode('placeholder'),
                'playbutton' => 'data:image/png;base64,' . base64_encode('playbutton'),
                'logo' => 'data:image/png;base64,' . base64_encode('logo'),
            ]
        ]);
    }

    public function test_with_empty_images(): void
    {
        $endpoint = new Update(1);

        $images = new Images();
        $endpoint->images($images);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
        ]);
    }

    public function test_with_availability(): void
    {
        $endpoint = new Update(1);

        // unix
        $availability = new Availability();
        $availability->scheduleStart(1674135633);
        $availability->scheduleEnd(1674135633);

        $endpoint->availability($availability);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'availability' => [
                'schedule_start' => 1674135633,
                'schedule_end' => 1674135633,
            ],
        ]);

        // string
        $availability = new Availability();
        $availability->scheduleStart('2023-01-19 15:41:43');
        $availability->scheduleEnd('2023-01-19 15:41:43');

        $endpoint->availability($availability);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'availability' => [
                'schedule_start' => '2023-01-19 15:41:43',
                'schedule_end' => '2023-01-19 15:41:43',
            ],
        ]);

        // Carbon
        $availability = new Availability();
        $availability->scheduleStart(Carbon::create(2023, 1, 19, 15, 41, 43));
        $availability->scheduleEnd(Carbon::create(2023, 1, 19, 15, 41, 43));

        $endpoint->availability($availability);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'availability' => [
                'schedule_start' => '2023-01-19 15:41:43',
                'schedule_end' => '2023-01-19 15:41:43',
            ],
        ]);
    }

    public function test_with_empty_availability(): void
    {
        $endpoint = new Update(1);

        $availability = new Availability();
        $endpoint->availability($availability);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
        ]);
    }

    public function test_with_input(): void
    {
        $endpoint = new Update(1);

        $input = new Input();
        $input->transcode(true);
        $input->transcoderId(1);
        $input->protocol(ProtocolEnum::SRT);
        $input->srtPassPhrase('srt_pass_phrase');
        $input->srtKeyLength(16);
        $input->serverPort(1);
        $input->serverApp('server_app');
        $input->autoShutdown(1);
        $input->videoPid('123');

        $language = new AudioLanguage();
        $language->language('lav');
        $language->pid('123');
        $language->languageName('Latvian');

        $packager = new Packager();
        $packager->primary(1);
        $packager->backup(1);

        $input->audioLanguages([$language]);
        $input->packagerIds($packager);

        $endpoint->input($input);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'input' => [
                'transcode' => 1,
                'transcoder_id' => 1,
                'protocol' => 'srt',
                'srt_pass_phrase' => 'srt_pass_phrase',
                'srt_key_length' => 16,
                'server_port' => 1,
                'server_app' => 'server_app',
                'auto_shutdown' => 1,
                'video_pid' => '123',
                'audio_languages' => [
                    [
                        'language' => 'lav',
                        'pid' => '123',
                        'language_name' => 'Latvian',
                    ],
                ],
                'packager_ids' => [
                    'primary' => 1,
                    'backup' => 1,
                ],
            ],
        ]);
    }

    public function test_with_empty_input(): void
    {
        $endpoint = new Update(1);

        $input = new Input();
        $endpoint->input($input);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
        ]);
    }

    public function test_with_timezone(): void
    {
        $endpoint = new Update(1);

        $endpoint->timezone('timezone');

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'id' => 1,
            'timezone' => 'timezone',
        ]);
    }
}