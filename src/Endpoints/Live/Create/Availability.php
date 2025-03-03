<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Live\Create;

use Carbon\CarbonInterface;
use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class Availability
{
    use CompilesProperties;

    protected string|int|CarbonInterface|null $schedule_start = null;

    protected string|int|CarbonInterface|null $schedule_end = null;

    public function scheduleStart(string|int|CarbonInterface $schedule_start): static
    {
        $this->schedule_start = $schedule_start;

        return $this;
    }

    public function scheduleEnd(string|int|CarbonInterface $schedule_end): static
    {
        $this->schedule_end = $schedule_end;

        return $this;
    }
}
