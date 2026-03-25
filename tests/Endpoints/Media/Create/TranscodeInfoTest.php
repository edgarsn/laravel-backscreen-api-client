<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\TranscodeInfo;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class TranscodeInfoTest extends TestCase
{
    public function test_empty(): void
    {
        $info = new TranscodeInfo;
        $this->assertEquals([], $info->compileAsArray());
    }

    public function test_dvb_lng_order(): void
    {
        $info = new TranscodeInfo;
        $info->dvbLngOrder('lv,en,ru');
        $this->assertEquals(['dvb_lng_order' => 'lv,en,ru'], $info->compileAsArray());
    }

    public function test_preset_id(): void
    {
        $info = new TranscodeInfo;
        $info->presetId(42);
        $this->assertEquals(['preset_id' => 42], $info->compileAsArray());
    }

    public function test_preset_id_invalid(): void
    {
        $info = new TranscodeInfo;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('preset_id must be >= 0');
        $info->presetId(-1);
    }

    public function test_preset_id_zero(): void
    {
        $info = new TranscodeInfo;
        $info->presetId(0);
        $this->assertEquals(['preset_id' => 0], $info->compileAsArray());
    }
}
