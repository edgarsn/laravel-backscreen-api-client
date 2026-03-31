<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class MultiAudioGroup
{
    use CompilesProperties;

    protected ?int $id = null;

    protected ?string $lang = null;

    protected ?string $name = null;

    protected ?string $channel_layout = null;

    /**
     * @var array<MultiAudioInputConfig>|null
     */
    protected ?array $input_configs = null;

    public function id(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * 3 letter ISO 639-2 code or empty string to use source language.
     */
    public function lang(string $lang): static
    {
        if (! preg_match('/^([a-zA-Z]{3})?$/', $lang)) {
            throw new \InvalidArgumentException('lang must be a 3-letter ISO 639-2 code or empty string');
        }

        $this->lang = $lang;

        return $this;
    }

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function channelLayout(string $channel_layout): static
    {
        $this->channel_layout = $channel_layout;

        return $this;
    }

    /**
     * @param  array<MultiAudioInputConfig>  $input_configs
     */
    public function inputConfigs(array $input_configs): static
    {
        $this->input_configs = $input_configs;

        return $this;
    }
}
