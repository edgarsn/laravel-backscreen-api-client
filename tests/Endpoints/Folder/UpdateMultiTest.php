<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\FolderList\TypeEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\UpdateMulti;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\UpdateMulti\UpdateItem;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class UpdateMultiTest extends TestCase
{
    public function test_with_required_arguments(): void
    {
        $this->makeBasicAuthEndpointTest(new UpdateMulti(TypeEnum::MEDIA), [], [
            'type' => 'media',
        ]);
    }

    public function test_with_delete_single_id(): void
    {
        $endpoint = new UpdateMulti(TypeEnum::MEDIA);
        $endpoint->delete(123);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'delete' => 123,
        ]);
    }

    public function test_with_delete_array_of_ids(): void
    {
        $endpoint = new UpdateMulti(TypeEnum::MEDIA);
        $endpoint->delete([123, 456]);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'delete' => [123, 456],
        ]);
    }

    public function test_with_update(): void
    {
        $item = new UpdateItem;
        $item->id(10);

        $endpoint = new UpdateMulti(TypeEnum::LIVE);
        $endpoint->update([$item]);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'live',
            'update' => [
                ['id' => 10],
            ],
        ]);
    }

    public function test_with_update_and_children(): void
    {
        $child = new UpdateItem;
        $child->id(20);

        $parent = new UpdateItem;
        $parent->id(10)->children([$child]);

        $endpoint = new UpdateMulti(TypeEnum::MEDIA);
        $endpoint->update([$parent]);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'update' => [
                [
                    'id' => 10,
                    'children' => [
                        ['id' => 20],
                    ],
                ],
            ],
        ]);
    }

    public function test_with_delete_and_update(): void
    {
        $item = new UpdateItem;

        $endpoint = new UpdateMulti(TypeEnum::MEDIA);
        $endpoint->delete(99)->update([$item]);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            'type' => 'media',
            'delete' => 99,
            'update' => [[]],
        ]);
    }
}
