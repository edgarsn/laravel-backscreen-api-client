<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Live\Create\Recording;

use Newman\LaravelTmsApiClient\Concerns\CompilesProperties;

class Nimbus
{
    use CompilesProperties;

    protected ?int $sync_interval = null;

    protected ?int $channel_id = null;

    protected ?int $manifest_id = null;

    public function syncInterval(int $sync_interval): static
    {
        $allowedValues = [0, 1, 5, 15, 30, 60, 120, 240];

        if (! in_array($sync_interval, $allowedValues)) {
            throw new \InvalidArgumentException('sync_interval must be one of: '.implode(', ', $allowedValues));
        }

        $this->sync_interval = $sync_interval;

        return $this;
    }

    public function channelId(int $channel_id): static
    {
        $this->channel_id = $channel_id;

        return $this;
    }

    public function manifestId(int $manifest_id): static
    {
        $this->manifest_id = $manifest_id;

        return $this;
    }
}
