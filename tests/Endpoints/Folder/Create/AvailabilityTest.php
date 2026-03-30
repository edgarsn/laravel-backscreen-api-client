<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Availability;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class AvailabilityTest extends TestCase
{
    public function test_empty(): void
    {
        $availability = new Availability;
        $this->assertEquals([], $availability->compileAsArray());
    }

    public function test_published(): void
    {
        $availability = new Availability;
        $availability->published(1);
        $this->assertEquals(['published' => 1], $availability->compileAsArray());
    }

    public function test_published_invalid(): void
    {
        $availability = new Availability;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('published must be 0 or 1');
        $availability->published(2);
    }

    public function test_expire_hours(): void
    {
        $availability = new Availability;
        $availability->expireHours(24);
        $this->assertEquals(['expire_hours' => 24], $availability->compileAsArray());
    }

    public function test_expire_hours_with_disable(): void
    {
        $availability = new Availability;
        $availability->expireHours(-1);
        $this->assertEquals(['expire_hours' => -1], $availability->compileAsArray());
    }

    public function test_expire_hours_invalid(): void
    {
        $availability = new Availability;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('expire_hours must be >= -1');
        $availability->expireHours(-2);
    }

    public function test_available_hours(): void
    {
        $availability = new Availability;
        $availability->availableHours(0);
        $this->assertEquals(['available_hours' => 0], $availability->compileAsArray());
    }

    public function test_available_hours_invalid(): void
    {
        $availability = new Availability;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('available_hours must be >= -1');
        $availability->availableHours(-2);
    }

    public function test_delete_source_after_transcode_hours(): void
    {
        $availability = new Availability;
        $availability->deleteSourceAfterTranscodeHours(48);
        $this->assertEquals(['delete_source_after_transcode_hours' => 48], $availability->compileAsArray());
    }

    public function test_delete_source_after_transcode_hours_invalid(): void
    {
        $availability = new Availability;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('delete_source_after_transcode_hours must be >= -1');
        $availability->deleteSourceAfterTranscodeHours(-2);
    }

    public function test_delete_source_av_after_transcode_hours(): void
    {
        $availability = new Availability;
        $availability->deleteSourceAvAfterTranscodeHours(0);
        $this->assertEquals(['delete_source_av_after_transcode_hours' => 0], $availability->compileAsArray());
    }

    public function test_delete_source_av_after_transcode_hours_invalid(): void
    {
        $availability = new Availability;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('delete_source_av_after_transcode_hours must be >= -1');
        $availability->deleteSourceAvAfterTranscodeHours(-2);
    }

    public function test_delete_transcode_after_upload_hours(): void
    {
        $availability = new Availability;
        $availability->deleteTranscodeAfterUploadHours(72);
        $this->assertEquals(['delete_transcode_after_upload_hours' => 72], $availability->compileAsArray());
    }

    public function test_delete_transcode_after_upload_hours_invalid(): void
    {
        $availability = new Availability;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('delete_transcode_after_upload_hours must be >= -1');
        $availability->deleteTranscodeAfterUploadHours(-2);
    }

    public function test_delete_all_after_upload_hours(): void
    {
        $availability = new Availability;
        $availability->deleteAllAfterUploadHours(-1);
        $this->assertEquals(['delete_all_after_upload_hours' => -1], $availability->compileAsArray());
    }

    public function test_delete_all_after_upload_hours_invalid(): void
    {
        $availability = new Availability;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('delete_all_after_upload_hours must be >= -1');
        $availability->deleteAllAfterUploadHours(-2);
    }

    public function test_delete_all_after_expire_hours(): void
    {
        $availability = new Availability;
        $availability->deleteAllAfterExpireHours(168);
        $this->assertEquals(['delete_all_after_expire_hours' => 168], $availability->compileAsArray());
    }

    public function test_delete_all_after_expire_hours_invalid(): void
    {
        $availability = new Availability;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('delete_all_after_expire_hours must be >= -1');
        $availability->deleteAllAfterExpireHours(-2);
    }
}
