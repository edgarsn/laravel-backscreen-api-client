<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class Player
{
    use CompilesProperties;

    protected ?string $logo_redirect = null;

    protected ?int $preload_content = null;

    protected ?int $extended_buffer = null;

    protected ?int $disable_pausing = null;

    /**
     * @var PlayerCustomTitle[]|null
     */
    protected ?array $custom_titles = null;

    protected ?string $singular_live = null;

    public function logoRedirect(string $logo_redirect): static
    {
        $this->logo_redirect = $logo_redirect;

        return $this;
    }

    public function preloadContent(int $preload_content): static
    {
        if (! in_array($preload_content, [0, 1])) {
            throw new \InvalidArgumentException('preload_content must be 0 or 1');
        }

        $this->preload_content = $preload_content;

        return $this;
    }

    public function extendedBuffer(int $extended_buffer): static
    {
        if (! in_array($extended_buffer, [0, 1])) {
            throw new \InvalidArgumentException('extended_buffer must be 0 or 1');
        }

        $this->extended_buffer = $extended_buffer;

        return $this;
    }

    public function disablePausing(int $disable_pausing): static
    {
        if (! in_array($disable_pausing, [0, 1])) {
            throw new \InvalidArgumentException('disable_pausing must be 0 or 1');
        }

        $this->disable_pausing = $disable_pausing;

        return $this;
    }

    /**
     * @param  PlayerCustomTitle[]  $custom_titles
     */
    public function customTitles(array $custom_titles): static
    {
        $this->custom_titles = $custom_titles;

        return $this;
    }

    public function singularLive(string $singular_live): static
    {
        $this->singular_live = $singular_live;

        return $this;
    }
}
