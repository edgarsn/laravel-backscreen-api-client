<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Live\Create;

use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Recording\EPG;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class EPGTest extends TestCase
{
    public function test(): void
    {
        $epg = new EPG;

        try {
            $epg->hoursBefore(0);
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('hours_before must be greater than or equal to 1 and less than or equal to 336', $e->getMessage());
        }

        try {
            $epg->hoursBefore(337);
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('hours_before must be greater than or equal to 1 and less than or equal to 336', $e->getMessage());
        }

        try {
            $epg->hoursAfter(0);
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('hours_after must be greater than or equal to 1 and less than or equal to 336', $e->getMessage());
        }

        try {
            $epg->hoursAfter(337);
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('hours_after must be greater than or equal to 1 and less than or equal to 336', $e->getMessage());
        }

        try {
            $epg->round(4);
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('round must be one of: 0, 1, 2, 3, 5, 10', $e->getMessage());
        }
    }
}
