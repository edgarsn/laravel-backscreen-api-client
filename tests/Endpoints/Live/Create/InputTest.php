<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Live\Create;

use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Enums\ProtocolEnum;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Input\AudioLanguage;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Input\Input;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Input\Packager;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class InputTest extends TestCase
{
    public function test(): void
    {
        $input = new Input;
        $input->transcode(true);
        $input->transcoderId(1);
        $input->protocol(ProtocolEnum::SRT);
        try {
            $input->srtPassPhrase('abc');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('srt_pass_phrase must be empty or between 10 and 79 characters long, when using SRT protocol', $e->getMessage());
        }

        try {
            $input->srtKeyLength(1);
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('srt_key_length must be empty or one of 0, 16, 24 or 32, when using SRT protocol', $e->getMessage());
        }

        $input->srtPassPhrase('srt_pass_phrase');
        $input->srtKeyLength(16);
        $input->serverPort(1);
        $input->serverApp('server_app');
        $input->autoShutdown(1);
        try {
            $input->videoPid('žž');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('video_pid must be an alphanumeric string', $e->getMessage());
        }
        $input->videoPid('123');

        $language = new AudioLanguage;
        $language->language('lav');
        $language->pid('123');
        $language->languageName('Latvian');

        $language2 = new AudioLanguage;
        $language2->language('eng');
        $language2->pid('456');
        $language2->languageName('English');

        $packager = new Packager;
        $packager->primary(1);
        $packager->backup(1);

        $input->audioLanguages([$language, $language2]);
        $input->packagerIds($packager);

        $this->assertEquals([
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
                [
                    'language' => 'eng',
                    'pid' => '456',
                    'language_name' => 'English',
                ],
            ],
            'packager_ids' => [
                'primary' => 1,
                'backup' => 1,
            ],
        ], $input->compileAsArray());
    }

    public function test_with_rtmp(): void
    {
        $input = new Input;
        $input->transcode(true);
        $input->transcoderId(1);
        $input->protocol(ProtocolEnum::RTMP);
        try {
            $input->srtPassPhrase('srt_pass_phrase');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('srt_pass_phrase can only be set when using SRT protocol', $e->getMessage());
        }

        try {
            $input->srtKeyLength(16);
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('srt_key_length can only be set when using SRT protocol', $e->getMessage());
        }

        $input->serverPort(1);
        $input->serverApp('server_app');
        try {
            $input->autoShutdown(777);
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('auto_shutdown must be one of 1, 2, 4, 8, 12, 18, 24, 48, 72, 96, 168', $e->getMessage());
        }
        $input->autoShutdown(1);

        try {
            $input->videoPid('123');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('video_pid can only be set when using SRT protocol', $e->getMessage());
        }

        $language = new AudioLanguage;
        $language->language('lav');
        $language->pid('123');
        $language->languageName('Latvian');

        $language2 = new AudioLanguage;
        $language2->language('eng');
        $language2->pid('456');
        $language2->languageName('English');

        $packager = new Packager;
        $packager->primary(1);
        $packager->backup(1);

        try {
            $input->audioLanguages([$language, $language2]);
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('audio_languages can only be set when using SRT protocol', $e->getMessage());
        }
        $input->packagerIds($packager);

        $this->assertEquals([
            'transcode' => 1,
            'transcoder_id' => 1,
            'protocol' => 'rtmp',
            'server_port' => 1,
            'server_app' => 'server_app',
            'auto_shutdown' => 1,
            'packager_ids' => [
                'primary' => 1,
                'backup' => 1,
            ],
        ], $input->compileAsArray());
    }
}
