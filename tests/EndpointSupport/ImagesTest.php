<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\EndpointSupport;

use Newman\LaravelTmsApiClient\EndpointSupport\Images;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class ImagesTest extends TestCase
{
    public function test(): void
    {
        $images = new Images();

        $encodedImage = 'data:image/png;base64,' . base64_encode('imagebase64_1');

        $images->thumbnail($encodedImage)
            ->placeholder($encodedImage)
            ->playbutton($encodedImage)
            ->logo($encodedImage);

        $this->assertEquals([
            'thumbnail' => $encodedImage,
            'placeholder' => $encodedImage,
            'playbutton' => $encodedImage,
            'logo' => $encodedImage,
        ], $images->compileAsArray());
    }

    public function test_with_non_base64(): void
    {
        $images = new Images();

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

        try {
            $images->playbutton('data:image/png;base64,imagebase64_1');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('playbutton must be a base64 encoded string', $e->getMessage());
        }

        try {
            $images->logo('data:image/png;base64,imagebase64_1');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('logo must be a base64 encoded string', $e->getMessage());
        }
    }

    public function test_without_metadata(): void
    {
        $images = new Images();

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

        try {
            $images->playbutton('imagebase64_1');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('playbutton must be a base64 encoded string', $e->getMessage());
        }

        try {
            $images->logo('imagebase64_1');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('logo must be a base64 encoded string', $e->getMessage());
        }
    }

    public function test_with_null(): void
    {
        $images = new Images();

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

        try {
            $images->playbutton(null);
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('playbutton must be a base64 encoded string', $e->getMessage());
        }

        try {
            $images->logo(null);
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('logo must be a base64 encoded string', $e->getMessage());
        }
    }
}
