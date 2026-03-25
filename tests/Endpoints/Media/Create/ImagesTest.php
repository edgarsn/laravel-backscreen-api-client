<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Images;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class ImagesTest extends TestCase
{
    public function test(): void
    {
        $images = new Images;

        $encodedImage = 'data:image/png;base64,'.base64_encode('imagebase64_1');

        $images->thumbnail($encodedImage)
            ->placeholder($encodedImage);

        $this->assertEquals([
            'thumbnail' => $encodedImage,
            'placeholder' => $encodedImage,
        ], $images->compileAsArray());
    }

    public function test_thumbnail_with_non_base64(): void
    {
        $images = new Images;

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('thumbnail must be a base64 encoded string');

        $images->thumbnail('data:image/png;base64,imagebase64_1');
    }

    public function test_placeholder_with_non_base64(): void
    {
        $images = new Images;

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('placeholder must be a base64 encoded string');

        $images->placeholder('data:image/png;base64,imagebase64_1');
    }

    public function test_thumbnail_without_metadata(): void
    {
        $images = new Images;

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('thumbnail must be a base64 encoded string');

        $images->thumbnail('imagebase64_1');
    }

    public function test_placeholder_without_metadata(): void
    {
        $images = new Images;

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('placeholder must be a base64 encoded string');

        $images->placeholder('imagebase64_1');
    }

    public function test_thumbnail_with_null(): void
    {
        $images = new Images;

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('thumbnail must be a base64 encoded string');

        $images->thumbnail(null);
    }

    public function test_placeholder_with_null(): void
    {
        $images = new Images;

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('placeholder must be a base64 encoded string');

        $images->placeholder(null);
    }
}
