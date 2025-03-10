<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Unit\Concerns;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList\StatusEnum;
use Newman\LaravelBackscreenApiClient\Tests\Support\TestClassWithProperties;
use Newman\LaravelBackscreenApiClient\Tests\Support\TestClassWithPropertiesAndExceptProperties;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class CompilesPropertiesConcernTest extends TestCase
{
    public function test(): void
    {
        $testClass = new TestClassWithProperties;

        $this->assertEquals([], $testClass->compilesAsArrayExceptProperties());

        $this->assertEquals([
            'name' => 'Name',
            'description' => 'Description',
        ], $testClass->compileAsArray());
    }

    public function test_with_excepted_properties(): void
    {
        $testClass = new TestClassWithPropertiesAndExceptProperties;

        $this->assertEquals(['status'], $testClass->compilesAsArrayExceptProperties());

        $this->assertEquals([
            'name' => 'Name',
            'description' => 'Description',
            'created_at' => '2023-01-19 15:41:43',
            'is_published' => 0,
            'status_enum' => StatusEnum::INGESTED->value,
            'child' => [
                'name' => 'Name',
                'description' => 'Description',
            ],
            'children' => [
                [
                    'name' => 'Name',
                    'description' => 'Description',
                ],
                [
                    'name' => 'Name',
                    'description' => 'Description',
                ],
            ],
        ], $testClass->compileAsArray());
    }
}
