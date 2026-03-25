<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Update;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\Enums\MaterialChangeTypeEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\MaterialChange;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\UpdateManifest;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class UpdateManifestTest extends TestCase
{
    public function test_empty(): void
    {
        $manifest = new UpdateManifest;
        $this->assertEquals([], $manifest->compileAsArray());
    }

    public function test_id(): void
    {
        $manifest = new UpdateManifest;
        $manifest->id(42);
        $this->assertEquals(['id' => 42], $manifest->compileAsArray());
    }

    public function test_start_at(): void
    {
        $manifest = new UpdateManifest;
        $manifest->startAt(100);
        $this->assertEquals(['start_at' => 100], $manifest->compileAsArray());
    }

    public function test_end_at(): void
    {
        $manifest = new UpdateManifest;
        $manifest->endAt(200);
        $this->assertEquals(['end_at' => 200], $manifest->compileAsArray());
    }

    public function test_material_change(): void
    {
        $manifest = new UpdateManifest;
        $change = new MaterialChange;
        $change->type(MaterialChangeTypeEnum::THUMBNAIL)->timestamp(1674135633);
        $manifest->materialChange($change);

        $this->assertEquals([
            'material_change' => [
                'type' => 'thumbnail',
                'timestamp' => 1674135633,
            ],
        ], $manifest->compileAsArray());
    }

    public function test_all_fields(): void
    {
        $manifest = new UpdateManifest;
        $change = new MaterialChange;
        $change->type(MaterialChangeTypeEnum::PLACEHOLDER);

        $manifest->id(1)->startAt(0)->endAt(300)->materialChange($change);

        $this->assertEquals([
            'id' => 1,
            'start_at' => 0,
            'end_at' => 300,
            'material_change' => ['type' => 'placeholder'],
        ], $manifest->compileAsArray());
    }
}
