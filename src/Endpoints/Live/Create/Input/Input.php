<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Live\Create\Input;

use Newman\LaravelTmsApiClient\Concerns\CompilesProperties;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Enums\ProtocolEnum;

class Input
{
    use CompilesProperties;

    protected ?bool $transcode = null;
    protected ?int $transcoder_id = null;
    protected ?ProtocolEnum $protocol = null;
    protected ?string $srt_pass_phrase = null;
    protected ?int $srt_key_length = null;
    protected ?int $server_port = null;
    protected ?string $server_app = null;
    protected ?int $auto_shutdown = null;
    protected ?string $video_pid = null;
    /**
     * @var array<AudioLanguage>|null
     */
    protected ?array $audio_languages = null;
    protected ?Packager $packager_ids = null;

     /**
     * Except properties in compilation.
     *
     * @return array<string>
     */
    public function compilesAsArrayExceptProperties(): array
    {
        if ($this->protocol === ProtocolEnum::RTMP) {
            return ['srt_pass_phrase', 'srt_key_length', 'video_pid', 'audio_languages'];
        };

        return [];
    }

    public function transcode(bool $transcode): static
    {
        $this->transcode = $transcode;

        return $this;
    }

    public function transcoderId(int $transcoder_id): static
    {
        $this->transcoder_id = $transcoder_id;

        return $this;
    }

    public function protocol(ProtocolEnum $protocol): static
    {
        $this->protocol = $protocol;

        if ($this->protocol === ProtocolEnum::RTMP) {
            $this->srt_pass_phrase = null;
        }

        return $this;
    }

    public function srtPassPhrase(string $srt_pass_phrase): static
    {
        if ($this->protocol === ProtocolEnum::RTMP) {
            throw new \InvalidArgumentException('srt_pass_phrase can only be set when using SRT protocol');
        }
        
        if (!empty($srt_pass_phrase) && strlen($srt_pass_phrase) < 10 || strlen($srt_pass_phrase) > 79) {
            throw new \InvalidArgumentException('srt_pass_phrase must be empty or between 10 and 79 characters long, when using SRT protocol');
        }

        $this->srt_pass_phrase = $srt_pass_phrase;

        return $this;
    }

    public function srtKeyLength(int $srt_key_length): static
    {
        if ($this->protocol === ProtocolEnum::RTMP) {
            throw new \InvalidArgumentException('srt_key_length can only be set when using SRT protocol');
        }

        $allowedValues = [0, 16, 24, 32];

        if (!in_array($srt_key_length, $allowedValues)) {
            throw new \InvalidArgumentException('srt_key_length must be empty or one of 0, 16, 24 or 32, when using SRT protocol');
        }

        $this->srt_key_length = $srt_key_length;

        return $this;
    }

    public function serverPort(int $server_port): static
    {
        $this->server_port = $server_port;

        return $this;
    }

    public function serverApp(string $server_app): static
    {
        $this->server_app = $server_app;

        return $this;
    }

    public function autoShutdown(int $auto_shutdown): static
    {
        $allowedValues = [1, 2, 4, 8, 12, 18, 24, 48, 72, 96, 168];

        if (!in_array($auto_shutdown, $allowedValues)) {
            throw new \InvalidArgumentException('auto_shutdown must be one of ' . implode(', ', $allowedValues));
        }

        $this->auto_shutdown = $auto_shutdown;

        return $this;
    }

    public function videoPid(string $video_pid): static
    {
        if($this->protocol === ProtocolEnum::RTMP) {
            throw new \InvalidArgumentException('video_pid can only be set when using SRT protocol');
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $video_pid)) {
            throw new \InvalidArgumentException('video_pid must be an alphanumeric string');
        }

        $this->video_pid = $video_pid;

        return $this;
    }

    /**
     * @param array<AudioLanguage> $audio_languages
     * @throws \InvalidArgumentException
     */
    public function audioLanguages(array $audio_languages): static
    {
        if($this->protocol === ProtocolEnum::RTMP) {
            throw new \InvalidArgumentException('audio_languages can only be set when using SRT protocol');
        }

        $this->audio_languages = $audio_languages;

        return $this;
    }

    public function packagerIds(Packager $packager_ids): static
    {
        $this->packager_ids = $packager_ids;

        return $this;
    }
}