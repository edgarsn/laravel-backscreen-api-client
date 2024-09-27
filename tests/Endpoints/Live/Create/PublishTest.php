<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Live\Create;

use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Publish;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class PublishTest extends TestCase
{
    public function test(): void
    {
        $publish = new Publish();

        $publish->prefix('prefix');

        $this->assertEquals([
            'prefix' => 'prefix',
        ], $publish->compileAsArray());
    }
}