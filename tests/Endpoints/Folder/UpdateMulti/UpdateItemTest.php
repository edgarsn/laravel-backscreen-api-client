<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder\UpdateMulti;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\UpdateMulti\UpdateItem;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class UpdateItemTest extends TestCase
{
    public function test_empty(): void
    {
        $item = new UpdateItem;
        $this->assertEquals([], $item->compileAsArray());
    }

    public function test_with_id(): void
    {
        $item = new UpdateItem;
        $item->id(42);
        $this->assertEquals(['id' => 42], $item->compileAsArray());
    }

    public function test_with_children(): void
    {
        $child = new UpdateItem;
        $child->id(10);

        $parent = new UpdateItem;
        $parent->id(1)->children([$child]);

        $this->assertEquals([
            'id' => 1,
            'children' => [
                ['id' => 10],
            ],
        ], $parent->compileAsArray());
    }

    public function test_with_deeply_nested_children(): void
    {
        $grandchild = new UpdateItem;
        $grandchild->id(100);

        $child = new UpdateItem;
        $child->id(10)->children([$grandchild]);

        $parent = new UpdateItem;
        $parent->id(1)->children([$child]);

        $this->assertEquals([
            'id' => 1,
            'children' => [
                [
                    'id' => 10,
                    'children' => [
                        ['id' => 100],
                    ],
                ],
            ],
        ], $parent->compileAsArray());
    }

    public function test_with_multiple_children(): void
    {
        $child1 = new UpdateItem;
        $child1->id(10);

        $child2 = new UpdateItem;
        $child2->id(20);

        $parent = new UpdateItem;
        $parent->children([$child1, $child2]);

        $this->assertEquals([
            'children' => [
                ['id' => 10],
                ['id' => 20],
            ],
        ], $parent->compileAsArray());
    }
}
