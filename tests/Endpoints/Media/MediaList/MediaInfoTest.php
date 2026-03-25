<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\MediaList;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList\MediaInfo;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class MediaInfoTest extends TestCase
{
    public function test_empty(): void
    {
        $info = new MediaInfo;
        $this->assertEquals([], $info->compileAsArray());
    }

    public function test_resolution(): void
    {
        $info = new MediaInfo;
        $info->resolution(['1920x1080', '1280x720']);
        $this->assertEquals(['resolution' => ['1920x1080', '1280x720']], $info->compileAsArray());
    }

    public function test_length(): void
    {
        $info = new MediaInfo;
        $info->length(['00:01:00', '00:02:00']);
        $this->assertEquals(['length' => ['00:01:00', '00:02:00']], $info->compileAsArray());
    }

    public function test_gop_type(): void
    {
        $info = new MediaInfo;
        $info->gopType(['open']);
        $this->assertEquals(['gop_type' => ['open']], $info->compileAsArray());
    }

    public function test_gop_size(): void
    {
        $info = new MediaInfo;
        $info->gopSize(['25', '50']);
        $this->assertEquals(['gop_size' => ['25', '50']], $info->compileAsArray());
    }

    public function test_frame_rate(): void
    {
        $info = new MediaInfo;
        $info->frameRate(['25', '29.97']);
        $this->assertEquals(['frame_rate' => ['25', '29.97']], $info->compileAsArray());
    }

    public function test_content_type(): void
    {
        $info = new MediaInfo;
        $info->contentType(['sdr', 'hdr']);
        $this->assertEquals(['content_type' => ['sdr', 'hdr']], $info->compileAsArray());
    }

    public function test_audio_type(): void
    {
        $info = new MediaInfo;
        $info->audioType(['stereo', '5.1']);
        $this->assertEquals(['audio_type' => ['stereo', '5.1']], $info->compileAsArray());
    }

    public function test_audio_tracks_count(): void
    {
        $info = new MediaInfo;
        $info->audioTracksCount(['1', '2']);
        $this->assertEquals(['audio_tracks_count' => ['1', '2']], $info->compileAsArray());
    }

    public function test_codec(): void
    {
        $info = new MediaInfo;
        $info->codec(['h264', 'h265']);
        $this->assertEquals(['codec' => ['h264', 'h265']], $info->compileAsArray());
    }

    public function test_language(): void
    {
        $info = new MediaInfo;
        $info->language(['lv', 'en']);
        $this->assertEquals(['language' => ['lv', 'en']], $info->compileAsArray());
    }

    public function test_subtitle_language(): void
    {
        $info = new MediaInfo;
        $info->subtitleLanguage(['lv', 'ru']);
        $this->assertEquals(['subtitle_language' => ['lv', 'ru']], $info->compileAsArray());
    }

    public function test_audio_language(): void
    {
        $info = new MediaInfo;
        $info->audioLanguage(['en']);
        $this->assertEquals(['audio_language' => ['en']], $info->compileAsArray());
    }
}
