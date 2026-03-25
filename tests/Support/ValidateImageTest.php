<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Support;

use Newman\LaravelBackscreenApiClient\Support\ValidateImage;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class ValidateImageTest extends TestCase
{
    public function test_null_returns_false(): void
    {
        $this->assertFalse(ValidateImage::verify(null));
    }

    public function test_valid_base64_image(): void
    {
        $encoded = 'data:image/png;base64,'.base64_encode('imagedata');
        $this->assertTrue(ValidateImage::verify($encoded));
    }

    public function test_without_data_prefix_returns_false(): void
    {
        $encoded = base64_encode('imagedata');
        $this->assertFalse(ValidateImage::verify($encoded));
    }

    public function test_without_base64_marker_returns_false(): void
    {
        $this->assertFalse(ValidateImage::verify('data:image/png;imagebase64'));
    }

    public function test_invalid_base64_returns_false(): void
    {
        $this->assertFalse(ValidateImage::verify('data:image/png;base64,not_valid_base64!!!'));
    }

    public function test_jpeg_image(): void
    {
        $encoded = 'data:image/jpeg;base64,'.base64_encode('fakejpegdata');
        $this->assertTrue(ValidateImage::verify($encoded));
    }
}
