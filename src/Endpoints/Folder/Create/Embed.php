<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class Embed
{
    use CompilesProperties;

    protected ?int $poster_from_thumbnail = null;

    protected ?int $enable_public = null;

    protected ?int $player_id = null;

    protected ?int $ad_id = null;

    protected ?int $protection_id = null;

    protected ?ShowRelated $show_related = null;

    public function posterFromThumbnail(int $poster_from_thumbnail): static
    {
        if (! in_array($poster_from_thumbnail, [0, 1])) {
            throw new \InvalidArgumentException('poster_from_thumbnail must be 0 or 1');
        }

        $this->poster_from_thumbnail = $poster_from_thumbnail;

        return $this;
    }

    public function enablePublic(int $enable_public): static
    {
        if (! in_array($enable_public, [0, 1])) {
            throw new \InvalidArgumentException('enable_public must be 0 or 1');
        }

        $this->enable_public = $enable_public;

        return $this;
    }

    /**
     * -1 = inherit, 0 = none, >0 = Specific ID.
     */
    public function playerId(int $player_id): static
    {
        if ($player_id < -1) {
            throw new \InvalidArgumentException('player_id must be >= -1');
        }

        $this->player_id = $player_id;

        return $this;
    }

    /**
     * -1 = inherit, 0 = none, >0 = Specific ID.
     */
    public function adId(int $ad_id): static
    {
        if ($ad_id < -1) {
            throw new \InvalidArgumentException('ad_id must be >= -1');
        }

        $this->ad_id = $ad_id;

        return $this;
    }

    /**
     * -1 = inherit, 0 = none, >0 = Specific ID.
     */
    public function protectionId(int $protection_id): static
    {
        if ($protection_id < -1) {
            throw new \InvalidArgumentException('protection_id must be >= -1');
        }

        $this->protection_id = $protection_id;

        return $this;
    }

    public function showRelated(?ShowRelated $show_related): static
    {
        $this->show_related = $show_related;

        return $this;
    }
}
