<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Enums\ShowRelatedTypeEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\ShowRelated;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class ShowRelatedTest extends TestCase
{
    public function test_empty(): void
    {
        $showRelated = new ShowRelated;
        $this->assertEquals([], $showRelated->compileAsArray());
    }

    public function test_type_folder(): void
    {
        $showRelated = new ShowRelated;
        $showRelated->type(ShowRelatedTypeEnum::FOLDER);
        $this->assertEquals(['type' => 'folder'], $showRelated->compileAsArray());
    }

    public function test_type_group(): void
    {
        $showRelated = new ShowRelated;
        $showRelated->type(ShowRelatedTypeEnum::GROUP);
        $this->assertEquals(['type' => 'group'], $showRelated->compileAsArray());
    }

    public function test_limit_valid(): void
    {
        $showRelated = new ShowRelated;
        $showRelated->limit(3);
        $this->assertEquals(['limit' => 3], $showRelated->compileAsArray());
    }

    public function test_limit_boundary_values(): void
    {
        $showRelated = new ShowRelated;
        $showRelated->limit(1);
        $this->assertEquals(['limit' => 1], $showRelated->compileAsArray());

        $showRelated->limit(6);
        $this->assertEquals(['limit' => 6], $showRelated->compileAsArray());
    }

    public function test_limit_invalid_low(): void
    {
        $showRelated = new ShowRelated;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('limit must be between 1 and 6');
        $showRelated->limit(0);
    }

    public function test_limit_invalid_high(): void
    {
        $showRelated = new ShowRelated;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('limit must be between 1 and 6');
        $showRelated->limit(7);
    }

    public function test_group_id(): void
    {
        $showRelated = new ShowRelated;
        $showRelated->groupId(0);
        $this->assertEquals(['group_id' => 0], $showRelated->compileAsArray());
    }

    public function test_group_id_positive(): void
    {
        $showRelated = new ShowRelated;
        $showRelated->groupId(42);
        $this->assertEquals(['group_id' => 42], $showRelated->compileAsArray());
    }

    public function test_group_id_invalid(): void
    {
        $showRelated = new ShowRelated;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('group_id must be >= 0');
        $showRelated->groupId(-1);
    }

    public function test_all_fields(): void
    {
        $showRelated = new ShowRelated;
        $showRelated->type(ShowRelatedTypeEnum::FOLDER)->limit(4)->groupId(10);

        $this->assertEquals([
            'type' => 'folder',
            'limit' => 4,
            'group_id' => 10,
        ], $showRelated->compileAsArray());
    }
}
