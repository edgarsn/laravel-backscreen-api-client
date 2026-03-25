<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Update;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\Enums\MaterialChangeTypeEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\MaterialChange;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class MaterialChangeTest extends TestCase
{
    public function test_empty(): void
    {
        $change = new MaterialChange;
        $this->assertEquals([], $change->compileAsArray());
    }

    public function test_type(): void
    {
        $change = new MaterialChange;
        $change->type(MaterialChangeTypeEnum::THUMBNAIL);
        $this->assertEquals(['type' => 'thumbnail'], $change->compileAsArray());
    }

    public function test_timestamp(): void
    {
        $change = new MaterialChange;
        $change->timestamp(1674135633);
        $this->assertEquals(['timestamp' => 1674135633], $change->compileAsArray());
    }

    public function test_all_fields(): void
    {
        $change = new MaterialChange;
        $change->type(MaterialChangeTypeEnum::PLACEHOLDER)->timestamp(1674135633);

        $this->assertEquals([
            'type' => 'placeholder',
            'timestamp' => 1674135633,
        ], $change->compileAsArray());
    }
}
