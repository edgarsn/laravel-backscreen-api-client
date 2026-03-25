<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Update;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Update\Images;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

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

    public function test_with_non_base64(): void
    {
        $images = new Images;

        try {
            $images->thumbnail('data:image/png;base64,imagebase64_1');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('thumbnail must be a base64 encoded string', $e->getMessage());
        }

        try {
            $images->placeholder('data:image/png;base64,imagebase64_1');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('placeholder must be a base64 encoded string', $e->getMessage());
        }
    }

    public function test_without_metadata(): void
    {
        $images = new Images;

        try {
            $images->thumbnail('imagebase64_1');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('thumbnail must be a base64 encoded string', $e->getMessage());
        }

        try {
            $images->placeholder('imagebase64_1');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('placeholder must be a base64 encoded string', $e->getMessage());
        }
    }

    public function test_with_null(): void
    {
        $images = new Images;

        try {
            $images->thumbnail(null);
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('thumbnail must be a base64 encoded string', $e->getMessage());
        }

        try {
            $images->placeholder(null);
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('placeholder must be a base64 encoded string', $e->getMessage());
        }
    }
}
