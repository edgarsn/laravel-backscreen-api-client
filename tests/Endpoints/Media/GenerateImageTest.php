<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Media;

use Newman\LaravelTmsApiClient\Endpoints\Media\GenerateImage;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class GenerateImageTest extends TestCase
{
    public function test_with_required_arguments(): void
    {
        $this->makeBearerAuthEndpointTest(new GenerateImage(123), [], [
            'id' => 123,
        ]);
    }

    public function test_with_media_file_id(): void
    {
        $endpoint = new GenerateImage(123);

        $endpoint->mediaFileId(1902);

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'media_file_id' => 1902,
        ]);
    }

    public function test_with_thumbnail(): void
    {
        $endpoint = new GenerateImage(123);

        $endpoint->thumbnail('01:20:39');

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'thumbnail' => '01:20:39',
        ]);
    }

    public function test_with_placeholder(): void
    {
        $endpoint = new GenerateImage(123);

        $endpoint->placeholder('00:05:30');

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'placeholder' => '00:05:30',
        ]);
    }
}
