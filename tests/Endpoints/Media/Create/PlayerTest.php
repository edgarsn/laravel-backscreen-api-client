<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\CustomTitleTypeEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Player;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\PlayerCustomTitle;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class PlayerTest extends TestCase
{
    public function test_empty(): void
    {
        $player = new Player;
        $this->assertEquals([], $player->compileAsArray());
    }

    public function test_logo_redirect(): void
    {
        $player = new Player;
        $player->logoRedirect('https://example.com');
        $this->assertEquals(['logo_redirect' => 'https://example.com'], $player->compileAsArray());
    }

    public function test_preload_content(): void
    {
        $player = new Player;
        $player->preloadContent(1);
        $this->assertEquals(['preload_content' => 1], $player->compileAsArray());
    }

    public function test_preload_content_invalid(): void
    {
        $player = new Player;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('preload_content must be 0 or 1');
        $player->preloadContent(2);
    }

    public function test_extended_buffer(): void
    {
        $player = new Player;
        $player->extendedBuffer(0);
        $this->assertEquals(['extended_buffer' => 0], $player->compileAsArray());
    }

    public function test_extended_buffer_invalid(): void
    {
        $player = new Player;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('extended_buffer must be 0 or 1');
        $player->extendedBuffer(2);
    }

    public function test_disable_pausing(): void
    {
        $player = new Player;
        $player->disablePausing(1);
        $this->assertEquals(['disable_pausing' => 1], $player->compileAsArray());
    }

    public function test_disable_pausing_invalid(): void
    {
        $player = new Player;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('disable_pausing must be 0 or 1');
        $player->disablePausing(2);
    }

    public function test_custom_titles(): void
    {
        $player = new Player;

        $title = new PlayerCustomTitle;
        $title->text('Hello World');
        $title->type(CustomTitleTypeEnum::BOTTOM_LEFT);

        $player->customTitles([$title]);

        $this->assertEquals([
            'custom_titles' => [
                [
                    'text' => 'Hello World',
                    'type' => 'bottom-left',
                ],
            ],
        ], $player->compileAsArray());
    }

    public function test_singular_live(): void
    {
        $player = new Player;
        $player->singularLive('stream-key');
        $this->assertEquals(['singular_live' => 'stream-key'], $player->compileAsArray());
    }
}
