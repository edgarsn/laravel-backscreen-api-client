<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Enums\DuplicateActionEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Ingest;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class IngestTest extends TestCase
{
    public function test_empty(): void
    {
        $ingest = new Ingest;
        $this->assertEquals([], $ingest->compileAsArray());
    }

    public function test_duplicate_action_append(): void
    {
        $ingest = new Ingest;
        $ingest->duplicateAction(DuplicateActionEnum::APPEND);
        $this->assertEquals(['duplicate_action' => 'append'], $ingest->compileAsArray());
    }

    public function test_duplicate_action_replace(): void
    {
        $ingest = new Ingest;
        $ingest->duplicateAction(DuplicateActionEnum::REPLACE);
        $this->assertEquals(['duplicate_action' => 'replace'], $ingest->compileAsArray());
    }

    public function test_update_asset_name(): void
    {
        $ingest = new Ingest;
        $ingest->updateAssetName(1);
        $this->assertEquals(['update_asset_name' => 1], $ingest->compileAsArray());
    }

    public function test_update_asset_name_invalid(): void
    {
        $ingest = new Ingest;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('update_asset_name must be 0 or 1');
        $ingest->updateAssetName(2);
    }

    public function test_use_tar_manifest(): void
    {
        $ingest = new Ingest;
        $ingest->useTarManifest(0);
        $this->assertEquals(['use_tar_manifest' => 0], $ingest->compileAsArray());
    }

    public function test_use_tar_manifest_invalid(): void
    {
        $ingest = new Ingest;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('use_tar_manifest must be 0 or 1');
        $ingest->useTarManifest(2);
    }

    public function test_tar_manifest_file(): void
    {
        $ingest = new Ingest;
        $ingest->tarManifestFile('manifest.json');
        $this->assertEquals(['tar_manifest_file' => 'manifest.json'], $ingest->compileAsArray());
    }

    public function test_subtitle_offset_valid(): void
    {
        $ingest = new Ingest;
        $ingest->subtitleOffset('00:00:10');
        $this->assertEquals(['subtitle_offset' => '00:00:10'], $ingest->compileAsArray());
    }

    public function test_subtitle_offset_valid_hours(): void
    {
        $ingest = new Ingest;
        $ingest->subtitleOffset('01:30:00');
        $this->assertEquals(['subtitle_offset' => '01:30:00'], $ingest->compileAsArray());
    }

    public function test_subtitle_offset_invalid(): void
    {
        $ingest = new Ingest;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('subtitle_offset must match hh:mm:ss format');
        $ingest->subtitleOffset('1:30:00');
    }

    public function test_subtitle_offset_invalid_format(): void
    {
        $ingest = new Ingest;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('subtitle_offset must match hh:mm:ss format');
        $ingest->subtitleOffset('invalid');
    }

    public function test_patterns(): void
    {
        $ingest = new Ingest;
        $ingest->patterns(['*.mp4', '*.mov']);
        $this->assertEquals(['patterns' => ['*.mp4', '*.mov']], $ingest->compileAsArray());
    }

    public function test_all_fields(): void
    {
        $ingest = new Ingest;
        $ingest->duplicateAction(DuplicateActionEnum::REPLACE)
            ->updateAssetName(1)
            ->useTarManifest(1)
            ->tarManifestFile('manifest.json')
            ->subtitleOffset('00:00:05')
            ->patterns(['*.mp4']);

        $this->assertEquals([
            'duplicate_action' => 'replace',
            'update_asset_name' => 1,
            'use_tar_manifest' => 1,
            'tar_manifest_file' => 'manifest.json',
            'subtitle_offset' => '00:00:05',
            'patterns' => ['*.mp4'],
        ], $ingest->compileAsArray());
    }
}
