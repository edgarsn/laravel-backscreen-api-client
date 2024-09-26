<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Live\Create;

use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Embed;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class EmbedTest extends TestCase
{
    public function test(): void
    {
        $embed = new Embed();

        $embed->enablePublic(true)
            ->publicPassword('password')
            ->enablePreview(true);

        $this->assertEquals([
            'enable_public' => true,
            'public_password' => 'password',
            'enable_preview' => true,
        ], $embed->compileAsArray());
    }
}