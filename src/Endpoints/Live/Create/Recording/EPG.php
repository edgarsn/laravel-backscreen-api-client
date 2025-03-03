<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Live\Create\Recording;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class EPG
{
    use CompilesProperties;

    protected ?int $hours_before = null;

    protected ?int $hours_after = null;

    protected ?int $round = null;

    public function hoursBefore(int $hours_before): static
    {
        if ($hours_before < 1 || $hours_before > 336) {
            throw new \InvalidArgumentException('hours_before must be greater than or equal to 1 and less than or equal to 336');
        }

        $this->hours_before = $hours_before;

        return $this;
    }

    public function hoursAfter(int $hours_after): static
    {
        if ($hours_after < 1 || $hours_after > 336) {
            throw new \InvalidArgumentException('hours_after must be greater than or equal to 1 and less than or equal to 336');
        }

        $this->hours_after = $hours_after;

        return $this;
    }

    public function round(int $round): static
    {
        $allowedValues = [0, 1, 2, 3, 5, 10];

        if (! in_array($round, $allowedValues)) {
            throw new \InvalidArgumentException('round must be one of: '.implode(', ', $allowedValues));
        }

        $this->round = $round;

        return $this;
    }
}
