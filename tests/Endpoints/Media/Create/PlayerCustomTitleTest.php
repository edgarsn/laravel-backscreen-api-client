<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\CustomTitleFontEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\CustomTitleTextSizeEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\CustomTitleTypeEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\PlayerCustomTitle;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class PlayerCustomTitleTest extends TestCase
{
    public function test_empty(): void
    {
        $title = new PlayerCustomTitle;
        $this->assertEquals([], $title->compileAsArray());
    }

    public function test_text(): void
    {
        $title = new PlayerCustomTitle;
        $title->text('My Title');
        $this->assertEquals(['text' => 'My Title'], $title->compileAsArray());
    }

    public function test_url_label(): void
    {
        $title = new PlayerCustomTitle;
        $title->urlLabel('https://example.com');
        $this->assertEquals(['url_label' => 'https://example.com'], $title->compileAsArray());
    }

    public function test_type(): void
    {
        $title = new PlayerCustomTitle;
        $title->type(CustomTitleTypeEnum::TOP_LEFT);
        $this->assertEquals(['type' => 'top-left'], $title->compileAsArray());
    }

    public function test_start_and_end(): void
    {
        $title = new PlayerCustomTitle;
        $title->start(10)->end(60);
        $this->assertEquals(['start' => 10, 'end' => 60], $title->compileAsArray());
    }

    public function test_font(): void
    {
        $title = new PlayerCustomTitle;
        $title->font(CustomTitleFontEnum::ARIAL);
        $this->assertEquals(['font' => 'Arial, Helvetica, sans-serif'], $title->compileAsArray());
    }

    public function test_color_hex(): void
    {
        $title = new PlayerCustomTitle;
        $title->color('#ffffff');
        $this->assertEquals(['color' => '#ffffff'], $title->compileAsArray());
    }

    public function test_color_rgba(): void
    {
        $title = new PlayerCustomTitle;
        $title->color('rgba(255,255,255,0.5)');
        $this->assertEquals(['color' => 'rgba(255,255,255,0.5)'], $title->compileAsArray());
    }

    public function test_color_invalid(): void
    {
        $title = new PlayerCustomTitle;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('color must be in #ffffff or rgba(255,255,255,0.5) format');
        $title->color('red');
    }

    public function test_background(): void
    {
        $title = new PlayerCustomTitle;
        $title->background('#000000');
        $this->assertEquals(['background' => '#000000'], $title->compileAsArray());
    }

    public function test_background_invalid(): void
    {
        $title = new PlayerCustomTitle;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('background must be in #ffffff or rgba(255,255,255,0.5) format');
        $title->background('blue');
    }

    public function test_text_size(): void
    {
        $title = new PlayerCustomTitle;
        $title->textSize(CustomTitleTextSizeEnum::SIZE_1_2);
        $this->assertEquals(['text_size' => '1.2'], $title->compileAsArray());
    }
}
