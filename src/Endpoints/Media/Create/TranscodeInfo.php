<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class TranscodeInfo
{
    use CompilesProperties;

    protected ?string $dvb_lng_order = null;

    protected ?int $preset_id = null;

    public function dvbLngOrder(string $dvb_lng_order): static
    {
        $this->dvb_lng_order = $dvb_lng_order;

        return $this;
    }

    public function presetId(int $preset_id): static
    {
        if ($preset_id < 0) {
            throw new \InvalidArgumentException('preset_id must be >= 0');
        }

        $this->preset_id = $preset_id;

        return $this;
    }
}
