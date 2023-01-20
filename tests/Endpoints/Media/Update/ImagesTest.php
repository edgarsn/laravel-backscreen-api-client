<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Media\Update;

use Newman\LaravelTmsApiClient\Endpoints\Media\Update\Images;
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
}
