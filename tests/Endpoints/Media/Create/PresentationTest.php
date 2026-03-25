<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Presentation;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\PresentationConfig;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class PresentationTest extends TestCase
{
    public function test_empty(): void
    {
        $presentation = new Presentation;
        $this->assertEquals([], $presentation->compileAsArray());
    }

    public function test_mode(): void
    {
        $presentation = new Presentation;
        $presentation->mode(1);
        $this->assertEquals(['mode' => 1], $presentation->compileAsArray());
    }

    public function test_mode_invalid(): void
    {
        $presentation = new Presentation;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('mode must be 0 or 1');
        $presentation->mode(2);
    }

    public function test_config_with_file_id(): void
    {
        $presentation = new Presentation;
        $config = new PresentationConfig;
        $config->fileId(123);
        $presentation->config($config);

        $this->assertEquals([
            'config' => ['file_id' => 123],
        ], $presentation->compileAsArray());
    }

    public function test_config_with_url(): void
    {
        $presentation = new Presentation;
        $config = new PresentationConfig;
        $config->url('https://example.com/presentation');
        $presentation->config($config);

        $this->assertEquals([
            'config' => ['url' => 'https://example.com/presentation'],
        ], $presentation->compileAsArray());
    }

    public function test_config_with_slides(): void
    {
        $presentation = new Presentation;
        $config = new PresentationConfig;
        $config->slides(['slide1.jpg', 'slide2.jpg']);
        $presentation->config($config);

        $this->assertEquals([
            'config' => ['slides' => ['slide1.jpg', 'slide2.jpg']],
        ], $presentation->compileAsArray());
    }
}
