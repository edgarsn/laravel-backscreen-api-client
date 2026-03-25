<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\UploadToExternal;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\UploadToExternal\CustomFile;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\UploadToExternal\PackageFile;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class UploadToExternalTest extends TestCase
{
    public function test_with_required_arguments(): void
    {
        $this->makeBearerAuthEndpointTest(new UploadToExternal(123, 456), [], [
            'id' => 123,
            'upload_destination_id' => 456,
        ]);
    }

    public function test_with_multiple_ids(): void
    {
        $this->makeBearerAuthEndpointTest(new UploadToExternal([1, 2], 99), [], [
            'id' => [1, 2],
            'upload_destination_id' => 99,
        ]);
    }

    public function test_with_package_files(): void
    {
        $endpoint = new UploadToExternal(123, 456);
        $endpoint->packageFiles([
            new PackageFile(10, 20),
            new PackageFile(11, 21),
        ]);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'upload_destination_id' => 456,
            'package_files' => [
                ['package_id' => 10, 'file_id' => 20],
                ['package_id' => 11, 'file_id' => 21],
            ],
        ]);
    }

    public function test_with_custom_files(): void
    {
        $endpoint = new UploadToExternal(123, 456);
        $endpoint->customFiles([
            new CustomFile(5, 'video.mp4'),
        ]);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'upload_destination_id' => 456,
            'custom_files' => [
                ['file_id' => 5, 'filename' => 'video.mp4'],
            ],
        ]);
    }

    public function test_with_path(): void
    {
        $endpoint = new UploadToExternal(123, 456);
        $endpoint->path('/my/custom/path');

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'upload_destination_id' => 456,
            'path' => '/my/custom/path',
        ]);
    }

    public function test_with_cat_dir(): void
    {
        $endpoint = new UploadToExternal(123, 456);
        $endpoint->catDir(1);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'upload_destination_id' => 456,
            'cat_dir' => 1,
        ]);
    }

    public function test_cat_dir_invalid(): void
    {
        $endpoint = new UploadToExternal(123, 456);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('cat_dir must be 0 or 1');
        $endpoint->catDir(2);
    }

    public function test_with_asset_dir(): void
    {
        $endpoint = new UploadToExternal(123, 456);
        $endpoint->assetDir(0);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'upload_destination_id' => 456,
            'asset_dir' => 0,
        ]);
    }

    public function test_asset_dir_invalid(): void
    {
        $endpoint = new UploadToExternal(123, 456);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('asset_dir must be 0 or 1');
        $endpoint->assetDir(2);
    }
}
