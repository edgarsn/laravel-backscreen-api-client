<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Embed;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\AspectRatioEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\PlayerProtocolEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\PlayerTypeEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\ProtocolEnum;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class EmbedTest extends TestCase
{
    public function test_empty(): void
    {
        $embed = new Embed;
        $this->assertEquals([], $embed->compileAsArray());
    }

    public function test_protocol(): void
    {
        $embed = new Embed;
        $embed->protocol(ProtocolEnum::HTTPS);
        $this->assertEquals(['protocol' => 'https'], $embed->compileAsArray());
    }

    public function test_player_type(): void
    {
        $embed = new Embed;
        $embed->playerType(PlayerTypeEnum::VR);
        $this->assertEquals(['player_type' => 'vr'], $embed->compileAsArray());
    }

    public function test_player_protocol(): void
    {
        $embed = new Embed;
        $embed->playerProtocol(PlayerProtocolEnum::HLS);
        $this->assertEquals(['player_protocol' => 'hls'], $embed->compileAsArray());
    }

    public function test_aspect_ratio(): void
    {
        $embed = new Embed;
        $embed->aspectRatio(AspectRatioEnum::RATIO_16_9);
        $this->assertEquals(['aspect_ratio' => '16:9'], $embed->compileAsArray());
    }

    public function test_autoplay(): void
    {
        $embed = new Embed;
        $embed->autoplay(1);
        $this->assertEquals(['autoplay' => 1], $embed->compileAsArray());
    }

    public function test_autoplay_invalid(): void
    {
        $embed = new Embed;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('autoplay must be 0 or 1');
        $embed->autoplay(2);
    }

    public function test_autosubs(): void
    {
        $embed = new Embed;
        $embed->autosubs(0);
        $this->assertEquals(['autosubs' => 0], $embed->compileAsArray());
    }

    public function test_autosubs_invalid(): void
    {
        $embed = new Embed;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('autosubs must be 0 or 1');
        $embed->autosubs(2);
    }

    public function test_mute(): void
    {
        $embed = new Embed;
        $embed->mute(1);
        $this->assertEquals(['mute' => 1], $embed->compileAsArray());
    }

    public function test_mute_invalid(): void
    {
        $embed = new Embed;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('mute must be 0 or 1');
        $embed->mute(5);
    }

    public function test_start_from(): void
    {
        $embed = new Embed;
        $embed->startFrom(30);
        $this->assertEquals(['start_from' => 30], $embed->compileAsArray());
    }

    public function test_start_random(): void
    {
        $embed = new Embed;
        $embed->startRandom(1);
        $this->assertEquals(['start_random' => 1], $embed->compileAsArray());
    }

    public function test_start_random_invalid(): void
    {
        $embed = new Embed;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('start_random must be 0 or 1');
        $embed->startRandom(2);
    }

    public function test_enable_public(): void
    {
        $embed = new Embed;
        $embed->enablePublic(1);
        $this->assertEquals(['enable_public' => 1], $embed->compileAsArray());
    }

    public function test_enable_public_invalid(): void
    {
        $embed = new Embed;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('enable_public must be 0 or 1');
        $embed->enablePublic(2);
    }

    public function test_public_password(): void
    {
        $embed = new Embed;
        $embed->publicPassword('secret');
        $this->assertEquals(['public_password' => 'secret'], $embed->compileAsArray());
    }

    public function test_enable_preview(): void
    {
        $embed = new Embed;
        $embed->enablePreview(0);
        $this->assertEquals(['enable_preview' => 0], $embed->compileAsArray());
    }

    public function test_enable_preview_invalid(): void
    {
        $embed = new Embed;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('enable_preview must be 0 or 1');
        $embed->enablePreview(2);
    }
}
