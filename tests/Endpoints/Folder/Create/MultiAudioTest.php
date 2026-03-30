<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\MultiAudio;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\MultiAudioConditions;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\MultiAudioGroup;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\MultiAudioInputConfig;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\MultiAudioTrack;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class MultiAudioTest extends TestCase
{
    public function test_empty(): void
    {
        $multiAudio = new MultiAudio;
        $this->assertEquals([], $multiAudio->compileAsArray());
    }

    public function test_with_groups(): void
    {
        $group = new MultiAudioGroup;
        $group->id(1)->lang('eng')->name('English');

        $multiAudio = new MultiAudio;
        $multiAudio->groups([$group]);

        $this->assertEquals([
            'groups' => [
                [
                    'id' => 1,
                    'lang' => 'eng',
                    'name' => 'English',
                ],
            ],
        ], $multiAudio->compileAsArray());
    }

    public function test_group_lang_empty_string(): void
    {
        $group = new MultiAudioGroup;
        $group->lang('');

        $this->assertEquals(['lang' => ''], $group->compileAsArray());
    }

    public function test_group_lang_invalid(): void
    {
        $group = new MultiAudioGroup;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('lang must be a 3-letter ISO 639-2 code or empty string');
        $group->lang('en');
    }

    public function test_group_lang_invalid_too_long(): void
    {
        $group = new MultiAudioGroup;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('lang must be a 3-letter ISO 639-2 code or empty string');
        $group->lang('english');
    }

    public function test_group_channel_layout(): void
    {
        $group = new MultiAudioGroup;
        $group->channelLayout('stereo');

        $this->assertEquals(['channel_layout' => 'stereo'], $group->compileAsArray());
    }

    public function test_group_with_input_configs(): void
    {
        $conditions = new MultiAudioConditions;
        $conditions->fileExt('ac3');

        $track = new MultiAudioTrack;
        $track->groupId(1)->layoutPosition('L')->overrideAudioUse(1);

        $inputConfig = new MultiAudioInputConfig;
        $inputConfig->name('Main')->conditions($conditions)->tracks([$track]);

        $group = new MultiAudioGroup;
        $group->id(1)->inputConfigs([$inputConfig]);

        $multiAudio = new MultiAudio;
        $multiAudio->groups([$group]);

        $this->assertEquals([
            'groups' => [
                [
                    'id' => 1,
                    'input_configs' => [
                        [
                            'name' => 'Main',
                            'conditions' => ['file_ext' => 'ac3'],
                            'tracks' => [
                                [
                                    'group_id' => 1,
                                    'layout_position' => 'L',
                                    'override_audio_use' => 1,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ], $multiAudio->compileAsArray());
    }

    public function test_track_override_audio_use_invalid(): void
    {
        $track = new MultiAudioTrack;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('override_audio_use must be 0 or 1');
        $track->overrideAudioUse(2);
    }

    public function test_conditions_file_ext(): void
    {
        $conditions = new MultiAudioConditions;
        $conditions->fileExt('mp3');
        $this->assertEquals(['file_ext' => 'mp3'], $conditions->compileAsArray());
    }

    public function test_empty_conditions(): void
    {
        $conditions = new MultiAudioConditions;
        $this->assertEquals([], $conditions->compileAsArray());
    }
}
