<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class MultiAudio
{
    use CompilesProperties;

    /**
     * @var array<MultiAudioGroup>|null
     */
    protected ?array $groups = null;

    /**
     * @param  array<MultiAudioGroup>  $groups
     */
    public function groups(array $groups): static
    {
        $this->groups = $groups;

        return $this;
    }
}
