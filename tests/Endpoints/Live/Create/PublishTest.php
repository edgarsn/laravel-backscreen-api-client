<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Live\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Live\Create\Publish;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class PublishTest extends TestCase
{
    public function test(): void
    {
        $publish = new Publish;

        $publish->prefix('prefix');

        $this->assertEquals([
            'prefix' => 'prefix',
        ], $publish->compileAsArray());
    }
}
