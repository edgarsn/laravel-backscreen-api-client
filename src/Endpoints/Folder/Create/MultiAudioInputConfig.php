<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class MultiAudioInputConfig
{
    use CompilesProperties;

    protected ?string $name = null;

    protected ?MultiAudioConditions $conditions = null;

    /**
     * @var array<MultiAudioTrack>|null
     */
    protected ?array $tracks = null;

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function conditions(?MultiAudioConditions $conditions): static
    {
        $this->conditions = $conditions;

        return $this;
    }

    /**
     * @param  array<MultiAudioTrack>  $tracks
     */
    public function tracks(array $tracks): static
    {
        $this->tracks = $tracks;

        return $this;
    }
}
