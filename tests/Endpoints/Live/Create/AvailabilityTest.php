<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Live\Create;

use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Availability;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class AvailabilityTest extends TestCase
{
    public function test(): void
    {
        $availability = new Availability;

        $availability->scheduleStart('2021-01-01 00:00:00');
        $availability->scheduleEnd('2021-01-01 23:59:59');

        $this->assertEquals([
            'schedule_start' => '2021-01-01 00:00:00',
            'schedule_end' => '2021-01-01 23:59:59',
        ], $availability->compileAsArray());
    }
}
