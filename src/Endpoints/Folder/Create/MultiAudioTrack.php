<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class MultiAudioTrack
{
    use CompilesProperties;

    protected ?int $group_id = null;

    protected ?string $layout_position = null;

    protected ?int $override_audio_use = null;

    /**
     * 0 indicates an ignored track.
     */
    public function groupId(int $group_id): static
    {
        $this->group_id = $group_id;

        return $this;
    }

    /**
     * Empty string indicates this track contains all audio channels for the specified group.
     */
    public function layoutPosition(string $layout_position): static
    {
        $this->layout_position = $layout_position;

        return $this;
    }

    /**
     * Overrides use checkbox for the particular audio file track. Allowed values: 0, 1.
     */
    public function overrideAudioUse(int $override_audio_use): static
    {
        if (! in_array($override_audio_use, [0, 1])) {
            throw new \InvalidArgumentException('override_audio_use must be 0 or 1');
        }

        $this->override_audio_use = $override_audio_use;

        return $this;
    }
}
