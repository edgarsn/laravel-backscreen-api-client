<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Enums\AutoTranscodeConditionEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Transcoding;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class TranscodingTest extends TestCase
{
    public function test_empty(): void
    {
        $transcoding = new Transcoding;
        $this->assertEquals([], $transcoding->compileAsArray());
    }

    public function test_preset_id(): void
    {
        $transcoding = new Transcoding;
        $transcoding->presetId(0);
        $this->assertEquals(['preset_id' => 0], $transcoding->compileAsArray());
    }

    public function test_preset_id_invalid(): void
    {
        $transcoding = new Transcoding;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('preset_id must be >= 0');
        $transcoding->presetId(-1);
    }

    public function test_auto_transcode_condition_minutes(): void
    {
        $transcoding = new Transcoding;
        $transcoding->autoTranscodeCondition(AutoTranscodeConditionEnum::MINUTES);
        $this->assertEquals(['auto_transcode_condition' => 'minutes'], $transcoding->compileAsArray());
    }

    public function test_auto_transcode_condition_manifest(): void
    {
        $transcoding = new Transcoding;
        $transcoding->autoTranscodeCondition(AutoTranscodeConditionEnum::MANIFEST);
        $this->assertEquals(['auto_transcode_condition' => 'manifest'], $transcoding->compileAsArray());
    }

    public function test_auto_transcode_after(): void
    {
        $transcoding = new Transcoding;
        $transcoding->autoTranscodeAfter(30);
        $this->assertEquals(['auto_transcode_after' => 30], $transcoding->compileAsArray());
    }

    public function test_auto_transcode_after_invalid(): void
    {
        $transcoding = new Transcoding;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('auto_transcode_after must be >= 0');
        $transcoding->autoTranscodeAfter(-1);
    }

    public function test_auto_repackage_condition_empty_string(): void
    {
        $transcoding = new Transcoding;
        $transcoding->autoRepackageCondition('');
        $this->assertEquals(['auto_repackage_condition' => ''], $transcoding->compileAsArray());
    }

    public function test_auto_repackage_condition_minutes(): void
    {
        $transcoding = new Transcoding;
        $transcoding->autoRepackageCondition('minutes');
        $this->assertEquals(['auto_repackage_condition' => 'minutes'], $transcoding->compileAsArray());
    }

    public function test_auto_repackage_condition_invalid(): void
    {
        $transcoding = new Transcoding;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('auto_repackage_condition must be empty string or "minutes"');
        $transcoding->autoRepackageCondition('hours');
    }

    public function test_auto_repackage_after(): void
    {
        $transcoding = new Transcoding;
        $transcoding->autoRepackageAfter(0);
        $this->assertEquals(['auto_repackage_after' => 0], $transcoding->compileAsArray());
    }

    public function test_auto_repackage_after_invalid(): void
    {
        $transcoding = new Transcoding;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('auto_repackage_after must be >= 0');
        $transcoding->autoRepackageAfter(-1);
    }

    public function test_re_transcode(): void
    {
        $transcoding = new Transcoding;
        $transcoding->reTrancode(1);
        $this->assertEquals(['re_transcode' => 1], $transcoding->compileAsArray());
    }

    public function test_re_transcode_invalid(): void
    {
        $transcoding = new Transcoding;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('re_transcode must be 0 or 1');
        $transcoding->reTrancode(2);
    }

    public function test_subtitle_strip_html(): void
    {
        $transcoding = new Transcoding;
        $transcoding->subtitleStripHtml(0);
        $this->assertEquals(['subtitle_strip_html' => 0], $transcoding->compileAsArray());
    }

    public function test_subtitle_strip_html_invalid(): void
    {
        $transcoding = new Transcoding;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('subtitle_strip_html must be 0 or 1');
        $transcoding->subtitleStripHtml(2);
    }

    public function test_subtitle_utf8_convert(): void
    {
        $transcoding = new Transcoding;
        $transcoding->subtitleUtf8Convert(1);
        $this->assertEquals(['subtitle_utf8_convert' => 1], $transcoding->compileAsArray());
    }

    public function test_subtitle_utf8_convert_invalid(): void
    {
        $transcoding = new Transcoding;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('subtitle_utf8_convert must be 0 or 1');
        $transcoding->subtitleUtf8Convert(2);
    }

    public function test_all_fields(): void
    {
        $transcoding = new Transcoding;
        $transcoding->presetId(5)
            ->autoTranscodeCondition(AutoTranscodeConditionEnum::MINUTES)
            ->autoTranscodeAfter(60)
            ->autoRepackageCondition('minutes')
            ->autoRepackageAfter(30)
            ->reTrancode(0)
            ->subtitleStripHtml(1)
            ->subtitleUtf8Convert(0);

        $this->assertEquals([
            'preset_id' => 5,
            'auto_transcode_condition' => 'minutes',
            'auto_transcode_after' => 60,
            'auto_repackage_condition' => 'minutes',
            'auto_repackage_after' => 30,
            're_transcode' => 0,
            'subtitle_strip_html' => 1,
            'subtitle_utf8_convert' => 0,
        ], $transcoding->compileAsArray());
    }
}
