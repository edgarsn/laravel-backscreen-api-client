<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Embed;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Enums\ShowRelatedTypeEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\ShowRelated;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class EmbedTest extends TestCase
{
    public function test_empty(): void
    {
        $embed = new Embed;
        $this->assertEquals([], $embed->compileAsArray());
    }

    public function test_poster_from_thumbnail(): void
    {
        $embed = new Embed;
        $embed->posterFromThumbnail(1);
        $this->assertEquals(['poster_from_thumbnail' => 1], $embed->compileAsArray());
    }

    public function test_poster_from_thumbnail_invalid(): void
    {
        $embed = new Embed;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('poster_from_thumbnail must be 0 or 1');
        $embed->posterFromThumbnail(2);
    }

    public function test_enable_public(): void
    {
        $embed = new Embed;
        $embed->enablePublic(0);
        $this->assertEquals(['enable_public' => 0], $embed->compileAsArray());
    }

    public function test_enable_public_invalid(): void
    {
        $embed = new Embed;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('enable_public must be 0 or 1');
        $embed->enablePublic(2);
    }

    public function test_player_id(): void
    {
        $embed = new Embed;
        $embed->playerId(-1);
        $this->assertEquals(['player_id' => -1], $embed->compileAsArray());
    }

    public function test_player_id_zero(): void
    {
        $embed = new Embed;
        $embed->playerId(0);
        $this->assertEquals(['player_id' => 0], $embed->compileAsArray());
    }

    public function test_player_id_invalid(): void
    {
        $embed = new Embed;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('player_id must be >= -1');
        $embed->playerId(-2);
    }

    public function test_ad_id(): void
    {
        $embed = new Embed;
        $embed->adId(5);
        $this->assertEquals(['ad_id' => 5], $embed->compileAsArray());
    }

    public function test_ad_id_invalid(): void
    {
        $embed = new Embed;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('ad_id must be >= -1');
        $embed->adId(-2);
    }

    public function test_protection_id(): void
    {
        $embed = new Embed;
        $embed->protectionId(0);
        $this->assertEquals(['protection_id' => 0], $embed->compileAsArray());
    }

    public function test_protection_id_invalid(): void
    {
        $embed = new Embed;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('protection_id must be >= -1');
        $embed->protectionId(-2);
    }

    public function test_show_related(): void
    {
        $showRelated = new ShowRelated;
        $showRelated->type(ShowRelatedTypeEnum::FOLDER)->limit(3);

        $embed = new Embed;
        $embed->showRelated($showRelated);

        $this->assertEquals([
            'show_related' => [
                'type' => 'folder',
                'limit' => 3,
            ],
        ], $embed->compileAsArray());
    }

    public function test_show_related_null(): void
    {
        $embed = new Embed;
        $embed->showRelated(null);
        $this->assertEquals([], $embed->compileAsArray());
    }

    public function test_all_fields(): void
    {
        $showRelated = new ShowRelated;
        $showRelated->type(ShowRelatedTypeEnum::GROUP)->groupId(1);

        $embed = new Embed;
        $embed->posterFromThumbnail(1)
            ->enablePublic(1)
            ->playerId(10)
            ->adId(20)
            ->protectionId(30)
            ->showRelated($showRelated);

        $this->assertEquals([
            'poster_from_thumbnail' => 1,
            'enable_public' => 1,
            'player_id' => 10,
            'ad_id' => 20,
            'protection_id' => 30,
            'show_related' => [
                'type' => 'group',
                'group_id' => 1,
            ],
        ], $embed->compileAsArray());
    }
}
