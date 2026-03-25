<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList;

use Carbon\CarbonInterface;
use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;
use Newman\LaravelBackscreenApiClient\EndpointSupport\Enums\OrderDirectionEnum;

class Popular
{
    use CompilesProperties;

    protected ?PopularSourceEnum $source = null;

    protected string|int|CarbonInterface|null $date_from = null;

    protected string|int|CarbonInterface|null $date_to = null;

    protected ?PeriodEnum $date_period = null;

    protected ?OrderDirectionEnum $order_dir = null;

    public function source(PopularSourceEnum $source): static
    {
        $this->source = $source;

        return $this;
    }

    public function dateFrom(string|int|CarbonInterface $date_from): static
    {
        $this->date_from = $date_from;

        return $this;
    }

    public function dateTo(string|int|CarbonInterface $date_to): static
    {
        $this->date_to = $date_to;

        return $this;
    }

    public function datePeriod(PeriodEnum $date_period): static
    {
        $this->date_period = $date_period;

        return $this;
    }

    public function orderDir(OrderDirectionEnum $order_dir): static
    {
        $this->order_dir = $order_dir;

        return $this;
    }
}
