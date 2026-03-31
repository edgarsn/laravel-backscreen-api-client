<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Delete;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\FolderList\TypeEnum;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class DeleteTest extends TestCase
{
    public function test_with_media_type(): void
    {
        $this->makeBasicAuthEndpointTest(new Delete(123, TypeEnum::MEDIA), [
            'id' => 123,
            'type' => 'media',
        ]);
    }

    public function test_with_live_type(): void
    {
        $this->makeBasicAuthEndpointTest(new Delete(456, TypeEnum::LIVE), [
            'id' => 456,
            'type' => 'live',
        ]);
    }
}
