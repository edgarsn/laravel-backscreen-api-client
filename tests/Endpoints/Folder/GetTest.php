<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\FolderList\TypeEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Get;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class GetTest extends TestCase
{
    public function test_with_required_arguments(): void
    {
        $this->makeBasicAuthEndpointTest(new Get(TypeEnum::MEDIA), [
            'type' => 'media',
        ]);
    }

    public function test_with_live_type(): void
    {
        $this->makeBasicAuthEndpointTest(new Get(TypeEnum::LIVE), [
            'type' => 'live',
        ]);
    }

    public function test_with_id(): void
    {
        $endpoint = new Get(TypeEnum::MEDIA);
        $endpoint->id(42);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'type' => 'media',
            'id' => 42,
        ]);
    }

    public function test_with_parent_id(): void
    {
        $endpoint = new Get(TypeEnum::MEDIA);
        $endpoint->parentId(10);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'type' => 'media',
            'parent_id' => 10,
        ]);
    }

    public function test_with_id_and_parent_id(): void
    {
        $endpoint = new Get(TypeEnum::MEDIA);
        $endpoint->id(42)->parentId(10);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'type' => 'media',
            'id' => 42,
            'parent_id' => 10,
        ]);
    }
}
