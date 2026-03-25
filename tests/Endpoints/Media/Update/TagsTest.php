<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Update;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\Tags;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class TagsTest extends TestCase
{
    public function test_empty(): void
    {
        $tags = new Tags;
        $this->assertEquals([], $tags->compileAsArray());
    }

    public function test_set(): void
    {
        $tags = new Tags;
        $tags->set(['tag1', 'tag2']);
        $this->assertEquals(['set' => ['tag1', 'tag2']], $tags->compileAsArray());
    }

    public function test_add(): void
    {
        $tags = new Tags;
        $tags->add(['tag3']);
        $this->assertEquals(['add' => ['tag3']], $tags->compileAsArray());
    }

    public function test_remove(): void
    {
        $tags = new Tags;
        $tags->remove(['tag1']);
        $this->assertEquals(['remove' => ['tag1']], $tags->compileAsArray());
    }

    public function test_all_fields(): void
    {
        $tags = new Tags;
        $tags->set(['tag1', 'tag2'])->add(['tag3'])->remove(['tag4']);

        $this->assertEquals([
            'set' => ['tag1', 'tag2'],
            'add' => ['tag3'],
            'remove' => ['tag4'],
        ], $tags->compileAsArray());
    }
}
