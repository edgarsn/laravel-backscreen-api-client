<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\AspectRatioEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\PlayerProtocolEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\PlayerTypeEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\ProtocolEnum;

class Embed
{
    use CompilesProperties;

    protected ?ProtocolEnum $protocol = null;

    protected ?PlayerTypeEnum $player_type = null;

    protected ?PlayerProtocolEnum $player_protocol = null;

    protected ?AspectRatioEnum $aspect_ratio = null;

    protected ?int $autoplay = null;

    protected ?int $autosubs = null;

    protected ?int $mute = null;

    protected ?int $start_from = null;

    protected ?int $start_random = null;

    protected ?int $enable_public = null;

    protected ?string $public_password = null;

    protected ?int $enable_preview = null;

    public function protocol(ProtocolEnum $protocol): static
    {
        $this->protocol = $protocol;

        return $this;
    }

    public function playerType(PlayerTypeEnum $player_type): static
    {
        $this->player_type = $player_type;

        return $this;
    }

    public function playerProtocol(PlayerProtocolEnum $player_protocol): static
    {
        $this->player_protocol = $player_protocol;

        return $this;
    }

    public function aspectRatio(AspectRatioEnum $aspect_ratio): static
    {
        $this->aspect_ratio = $aspect_ratio;

        return $this;
    }

    public function autoplay(int $autoplay): static
    {
        if (! in_array($autoplay, [0, 1])) {
            throw new \InvalidArgumentException('autoplay must be 0 or 1');
        }

        $this->autoplay = $autoplay;

        return $this;
    }

    public function autosubs(int $autosubs): static
    {
        if (! in_array($autosubs, [0, 1])) {
            throw new \InvalidArgumentException('autosubs must be 0 or 1');
        }

        $this->autosubs = $autosubs;

        return $this;
    }

    public function mute(int $mute): static
    {
        if (! in_array($mute, [0, 1])) {
            throw new \InvalidArgumentException('mute must be 0 or 1');
        }

        $this->mute = $mute;

        return $this;
    }

    public function startFrom(int $start_from): static
    {
        $this->start_from = $start_from;

        return $this;
    }

    public function startRandom(int $start_random): static
    {
        if (! in_array($start_random, [0, 1])) {
            throw new \InvalidArgumentException('start_random must be 0 or 1');
        }

        $this->start_random = $start_random;

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

    public function publicPassword(string $public_password): static
    {
        $this->public_password = $public_password;

        return $this;
    }

    public function enablePreview(int $enable_preview): static
    {
        if (! in_array($enable_preview, [0, 1])) {
            throw new \InvalidArgumentException('enable_preview must be 0 or 1');
        }

        $this->enable_preview = $enable_preview;

        return $this;
    }
}
