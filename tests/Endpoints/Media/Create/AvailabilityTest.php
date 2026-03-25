<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Availability;
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

    public function test_expire_time_as_string(): void
    {
        $availability = new Availability;
        $availability->expireTime('2026-03-25 12:34:56');
        $this->assertEquals(['expire_time' => '2026-03-25 12:34:56'], $availability->compileAsArray());
    }

    public function test_expire_time_as_int(): void
    {
        $availability = new Availability;
        $availability->expireTime(1774135633);
        $this->assertEquals(['expire_time' => 1774135633], $availability->compileAsArray());
    }

    public function test_available_time(): void
    {
        $availability = new Availability;
        $availability->availableTime('2026-01-01 00:00:00');
        $this->assertEquals(['available_time' => '2026-01-01 00:00:00'], $availability->compileAsArray());
    }

    public function test_delete_source_after_transcode_hours(): void
    {
        $availability = new Availability;
        $availability->deleteSourceAfterTranscodeHours(24);
        $this->assertEquals(['delete_source_after_transcode_hours' => 24], $availability->compileAsArray());
    }

    public function test_delete_source_after_transcode_hours_with_disable(): void
    {
        $availability = new Availability;
        $availability->deleteSourceAfterTranscodeHours(-1);
        $this->assertEquals(['delete_source_after_transcode_hours' => -1], $availability->compileAsArray());
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
        $availability->deleteTranscodeAfterUploadHours(48);
        $this->assertEquals(['delete_transcode_after_upload_hours' => 48], $availability->compileAsArray());
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
        $availability->deleteAllAfterExpireHours(72);
        $this->assertEquals(['delete_all_after_expire_hours' => 72], $availability->compileAsArray());
    }

    public function test_delete_all_after_expire_hours_invalid(): void
    {
        $availability = new Availability;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('delete_all_after_expire_hours must be >= -1');
        $availability->deleteAllAfterExpireHours(-2);
    }
}
