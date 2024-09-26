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

        $images->thumbnail('aW1hZ2ViYXNlNjRfMQ==')
            ->placeholder('aW1hZ2ViYXNlNjRfMg==')
            ->playbutton('aW1hZ2ViYXNlNjRfMw==')
            ->logo('aW1hZ2ViYXNlNjRfNA==');

        $this->assertEquals([
            'thumbnail' => 'aW1hZ2ViYXNlNjRfMQ==',
            'placeholder' => 'aW1hZ2ViYXNlNjRfMg==',
            'playbutton' => 'aW1hZ2ViYXNlNjRfMw==',
            'logo' => 'aW1hZ2ViYXNlNjRfNA==',
        ], $images->compileAsArray());
    }

    public function test_with_non_base64(): void
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
