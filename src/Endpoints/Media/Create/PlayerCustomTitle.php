<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\CustomTitleFontEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\CustomTitleTextSizeEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\CustomTitleTypeEnum;

class PlayerCustomTitle
{
    use CompilesProperties;

    protected ?string $text = null;

    protected ?string $url_label = null;

    protected ?CustomTitleTypeEnum $type = null;

    protected ?int $start = null;

    protected ?int $end = null;

    protected ?CustomTitleFontEnum $font = null;

    protected ?string $color = null;

    protected ?string $background = null;

    protected ?CustomTitleTextSizeEnum $text_size = null;

    public function text(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function urlLabel(string $url_label): static
    {
        $this->url_label = $url_label;

        return $this;
    }

    public function type(CustomTitleTypeEnum $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function start(int $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function end(int $end): static
    {
        $this->end = $end;

        return $this;
    }

    public function font(CustomTitleFontEnum $font): static
    {
        $this->font = $font;

        return $this;
    }

    public function color(string $color): static
    {
        if (! preg_match('/^(#[a-fA-F0-9]{6}|rgba\((\s*\d+\s*,){3}[\d\.]+\))$/', $color)) {
            throw new \InvalidArgumentException('color must be in #ffffff or rgba(255,255,255,0.5) format');
        }

        $this->color = $color;

        return $this;
    }

    public function background(string $background): static
    {
        if (! preg_match('/^(#[a-fA-F0-9]{6}|rgba\((\s*\d+\s*,){3}[\d\.]+\))$/', $background)) {
            throw new \InvalidArgumentException('background must be in #ffffff or rgba(255,255,255,0.5) format');
        }

        $this->background = $background;

        return $this;
    }

    public function textSize(CustomTitleTextSizeEnum $text_size): static
    {
        $this->text_size = $text_size;

        return $this;
    }
}
