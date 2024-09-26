<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Live\Create;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Recording\Nimbus;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class NimbusTest extends TestCase
{
    public function test(): void
    {
        $nimbus = new Nimbus();

        try {
            $nimbus->syncInterval(2);
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('sync_interval must be one of: 0, 1, 5, 15, 30, 60, 120, 240', $e->getMessage());
        }
    }
}