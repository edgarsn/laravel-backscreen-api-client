<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\ExternalUploads;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class ExternalUploadsTest extends TestCase
{
    public function test_empty(): void
    {
        $externalUploads = new ExternalUploads;
        $this->assertEquals([], $externalUploads->compileAsArray());
    }

    public function test_upload_automatically(): void
    {
        $externalUploads = new ExternalUploads;
        $externalUploads->uploadAutomatically(1);
        $this->assertEquals(['upload_automatically' => 1], $externalUploads->compileAsArray());
    }

    public function test_upload_automatically_disable(): void
    {
        $externalUploads = new ExternalUploads;
        $externalUploads->uploadAutomatically(0);
        $this->assertEquals(['upload_automatically' => 0], $externalUploads->compileAsArray());
    }

    public function test_upload_automatically_invalid(): void
    {
        $externalUploads = new ExternalUploads;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('upload_automatically must be 0 or 1');
        $externalUploads->uploadAutomatically(2);
    }

    public function test_outputs(): void
    {
        $externalUploads = new ExternalUploads;
        $externalUploads->outputs([['url' => 'ftp://example.com']]);
        $this->assertEquals([
            'outputs' => [['url' => 'ftp://example.com']],
        ], $externalUploads->compileAsArray());
    }

    public function test_all_fields(): void
    {
        $externalUploads = new ExternalUploads;
        $externalUploads->uploadAutomatically(1)->outputs([['url' => 's3://bucket/path']]);

        $this->assertEquals([
            'upload_automatically' => 1,
            'outputs' => [['url' => 's3://bucket/path']],
        ], $externalUploads->compileAsArray());
    }
}
