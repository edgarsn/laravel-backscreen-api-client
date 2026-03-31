<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Enums\AutoTranscodeConditionEnum;

class Transcoding
{
    use CompilesProperties;

    protected ?int $preset_id = null;

    protected ?AutoTranscodeConditionEnum $auto_transcode_condition = null;

    protected ?int $auto_transcode_after = null;

    protected ?string $auto_repackage_condition = null;

    protected ?int $auto_repackage_after = null;

    protected ?int $re_transcode = null;

    protected ?int $subtitle_strip_html = null;

    protected ?int $subtitle_utf8_convert = null;

    /**
     * Must be >= 0.
     */
    public function presetId(int $preset_id): static
    {
        if ($preset_id < 0) {
            throw new \InvalidArgumentException('preset_id must be >= 0');
        }

        $this->preset_id = $preset_id;

        return $this;
    }

    public function autoTranscodeCondition(AutoTranscodeConditionEnum $auto_transcode_condition): static
    {
        $this->auto_transcode_condition = $auto_transcode_condition;

        return $this;
    }

    /**
     * Must be >= 0.
     */
    public function autoTranscodeAfter(int $auto_transcode_after): static
    {
        if ($auto_transcode_after < 0) {
            throw new \InvalidArgumentException('auto_transcode_after must be >= 0');
        }

        $this->auto_transcode_after = $auto_transcode_after;

        return $this;
    }

    /**
     * Empty string disables auto-repackage. 'minutes' enables it.
     */
    public function autoRepackageCondition(string $auto_repackage_condition): static
    {
        if ($auto_repackage_condition !== '' && $auto_repackage_condition !== 'minutes') {
            throw new \InvalidArgumentException('auto_repackage_condition must be empty string or "minutes"');
        }

        $this->auto_repackage_condition = $auto_repackage_condition;

        return $this;
    }

    /**
     * Minutes after which to auto-repackage. 0 triggers immediately. Must be >= 0.
     */
    public function autoRepackageAfter(int $auto_repackage_after): static
    {
        if ($auto_repackage_after < 0) {
            throw new \InvalidArgumentException('auto_repackage_after must be >= 0');
        }

        $this->auto_repackage_after = $auto_repackage_after;

        return $this;
    }

    public function reTrancode(int $re_transcode): static
    {
        if (! in_array($re_transcode, [0, 1])) {
            throw new \InvalidArgumentException('re_transcode must be 0 or 1');
        }

        $this->re_transcode = $re_transcode;

        return $this;
    }

    public function subtitleStripHtml(int $subtitle_strip_html): static
    {
        if (! in_array($subtitle_strip_html, [0, 1])) {
            throw new \InvalidArgumentException('subtitle_strip_html must be 0 or 1');
        }

        $this->subtitle_strip_html = $subtitle_strip_html;

        return $this;
    }

    public function subtitleUtf8Convert(int $subtitle_utf8_convert): static
    {
        if (! in_array($subtitle_utf8_convert, [0, 1])) {
            throw new \InvalidArgumentException('subtitle_utf8_convert must be 0 or 1');
        }

        $this->subtitle_utf8_convert = $subtitle_utf8_convert;

        return $this;
    }
}
