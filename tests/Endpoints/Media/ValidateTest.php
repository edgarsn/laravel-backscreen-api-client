<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Validate;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class ValidateTest extends TestCase
{
    public function test_with_single_id(): void
    {
        $this->makeBearerAuthEndpointTest(new Validate(123), [], [
            'id' => 123,
        ]);
    }

    public function test_with_multiple_ids(): void
    {
        $this->makeBearerAuthEndpointTest(new Validate([1, 2, 3]), [], [
            'id' => [1, 2, 3],
        ]);
    }

    public function test_with_transcode(): void
    {
        $endpoint = new Validate(123);
        $endpoint->transcode(1);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'transcode' => 1,
        ]);
    }

    public function test_transcode_invalid(): void
    {
        $endpoint = new Validate(123);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('transcode must be 0 or 1');
        $endpoint->transcode(2);
    }

    public function test_with_transcode_priority(): void
    {
        $endpoint = new Validate(123);
        $endpoint->transcodePriority(1);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'transcode_priority' => 1,
        ]);
    }

    public function test_transcode_priority_invalid(): void
    {
        $endpoint = new Validate(123);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('transcode_priority must be 0 or 1');
        $endpoint->transcodePriority(2);
    }

    public function test_with_transcoding_preset_id(): void
    {
        $endpoint = new Validate(123);
        $endpoint->transcodingPresetId(42);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'transcoding_preset_id' => 42,
        ]);
    }

    public function test_with_all_fields(): void
    {
        $endpoint = new Validate([10, 20]);
        $endpoint->transcode(1)->transcodePriority(0)->transcodingPresetId(5);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'id' => [10, 20],
            'transcode' => 1,
            'transcode_priority' => 0,
            'transcoding_preset_id' => 5,
        ]);
    }
}
