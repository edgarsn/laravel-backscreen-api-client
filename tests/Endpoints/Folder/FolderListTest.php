<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\FolderList;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\FolderList\TypeEnum;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class FolderListTest extends TestCase
{
    public function test_with_single_type(): void
    {
        $this->makeBasicAuthEndpointTest(new FolderList(TypeEnum::MEDIA), [
            'type' => ['media'],
        ]);
    }

    public function test_with_live_type(): void
    {
        $this->makeBasicAuthEndpointTest(new FolderList(TypeEnum::LIVE), [
            'type' => ['live'],
        ]);
    }

    public function test_with_multiple_types(): void
    {
        $this->makeBasicAuthEndpointTest(new FolderList([TypeEnum::LIVE, TypeEnum::MEDIA]), [
            'type' => ['live', 'media'],
        ]);
    }
}
