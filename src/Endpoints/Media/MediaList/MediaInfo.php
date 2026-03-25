<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class MediaInfo
{
    use CompilesProperties;

    /**
     * @var array<string>|null
     */
    protected ?array $resolution = null;

    /**
     * hh:mm:ss values
     *
     * @var array<string>|null
     */
    protected ?array $length = null;

    /**
     * @var array<string>|null
     */
    protected ?array $gop_type = null;

    /**
     * @var array<string>|null
     */
    protected ?array $gop_size = null;

    /**
     * @var array<string>|null
     */
    protected ?array $frame_rate = null;

    /**
     * e.g. sdr, hdr
     *
     * @var array<string>|null
     */
    protected ?array $content_type = null;

    /**
     * e.g. mono, stereo, 5.1, 7.1
     *
     * @var array<string>|null
     */
    protected ?array $audio_type = null;

    /**
     * @var array<string>|null
     */
    protected ?array $audio_tracks_count = null;

    /**
     * @var array<string>|null
     */
    protected ?array $codec = null;

    /**
     * @var array<string>|null
     */
    protected ?array $language = null;

    /**
     * @var array<string>|null
     */
    protected ?array $subtitle_language = null;

    /**
     * @var array<string>|null
     */
    protected ?array $audio_language = null;

    /** @param array<string> $resolution */
    public function resolution(array $resolution): static
    {
        $this->resolution = $resolution;

        return $this;
    }

    /** @param array<string> $length */
    public function length(array $length): static
    {
        $this->length = $length;

        return $this;
    }

    /** @param array<string> $gop_type */
    public function gopType(array $gop_type): static
    {
        $this->gop_type = $gop_type;

        return $this;
    }

    /** @param array<string> $gop_size */
    public function gopSize(array $gop_size): static
    {
        $this->gop_size = $gop_size;

        return $this;
    }

    /** @param array<string> $frame_rate */
    public function frameRate(array $frame_rate): static
    {
        $this->frame_rate = $frame_rate;

        return $this;
    }

    /** @param array<string> $content_type */
    public function contentType(array $content_type): static
    {
        $this->content_type = $content_type;

        return $this;
    }

    /** @param array<string> $audio_type */
    public function audioType(array $audio_type): static
    {
        $this->audio_type = $audio_type;

        return $this;
    }

    /** @param array<string> $audio_tracks_count */
    public function audioTracksCount(array $audio_tracks_count): static
    {
        $this->audio_tracks_count = $audio_tracks_count;

        return $this;
    }

    /** @param array<string> $codec */
    public function codec(array $codec): static
    {
        $this->codec = $codec;

        return $this;
    }

    /** @param array<string> $language */
    public function language(array $language): static
    {
        $this->language = $language;

        return $this;
    }

    /** @param array<string> $subtitle_language */
    public function subtitleLanguage(array $subtitle_language): static
    {
        $this->subtitle_language = $subtitle_language;

        return $this;
    }

    /** @param array<string> $audio_language */
    public function audioLanguage(array $audio_language): static
    {
        $this->audio_language = $audio_language;

        return $this;
    }
}
