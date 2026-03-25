<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class Availability
{
    use CompilesProperties;

    protected ?int $published = null;

    protected int|string|null $expire_time = null;

    protected int|string|null $available_time = null;

    protected ?int $delete_source_after_transcode_hours = null;

    protected ?int $delete_source_av_after_transcode_hours = null;

    protected ?int $delete_transcode_after_upload_hours = null;

    protected ?int $delete_all_after_upload_hours = null;

    protected ?int $delete_all_after_expire_hours = null;

    public function published(int $published): static
    {
        if (! in_array($published, [0, 1])) {
            throw new \InvalidArgumentException('published must be 0 or 1');
        }

        $this->published = $published;

        return $this;
    }

    /**
     * Accepts a UNIX timestamp (integer) or a datetime string e.g. "2026-03-25 12:34:56".
     */
    public function expireTime(int|string $expire_time): static
    {
        $this->expire_time = $expire_time;

        return $this;
    }

    /**
     * Accepts a UNIX timestamp (integer) or a datetime string e.g. "2026-03-25 12:34:56".
     */
    public function availableTime(int|string $available_time): static
    {
        $this->available_time = $available_time;

        return $this;
    }

    /**
     * Use 0 to delete immediately, -1 to disable.
     */
    public function deleteSourceAfterTranscodeHours(int $delete_source_after_transcode_hours): static
    {
        if ($delete_source_after_transcode_hours < -1) {
            throw new \InvalidArgumentException('delete_source_after_transcode_hours must be >= -1');
        }

        $this->delete_source_after_transcode_hours = $delete_source_after_transcode_hours;

        return $this;
    }

    /**
     * Use 0 to delete immediately, -1 to disable.
     */
    public function deleteSourceAvAfterTranscodeHours(int $delete_source_av_after_transcode_hours): static
    {
        if ($delete_source_av_after_transcode_hours < -1) {
            throw new \InvalidArgumentException('delete_source_av_after_transcode_hours must be >= -1');
        }

        $this->delete_source_av_after_transcode_hours = $delete_source_av_after_transcode_hours;

        return $this;
    }

    /**
     * Use 0 to delete immediately, -1 to disable.
     */
    public function deleteTranscodeAfterUploadHours(int $delete_transcode_after_upload_hours): static
    {
        if ($delete_transcode_after_upload_hours < -1) {
            throw new \InvalidArgumentException('delete_transcode_after_upload_hours must be >= -1');
        }

        $this->delete_transcode_after_upload_hours = $delete_transcode_after_upload_hours;

        return $this;
    }

    /**
     * Use 0 to delete immediately, -1 to disable.
     */
    public function deleteAllAfterUploadHours(int $delete_all_after_upload_hours): static
    {
        if ($delete_all_after_upload_hours < -1) {
            throw new \InvalidArgumentException('delete_all_after_upload_hours must be >= -1');
        }

        $this->delete_all_after_upload_hours = $delete_all_after_upload_hours;

        return $this;
    }

    /**
     * Use 0 to delete immediately, -1 to disable.
     */
    public function deleteAllAfterExpireHours(int $delete_all_after_expire_hours): static
    {
        if ($delete_all_after_expire_hours < -1) {
            throw new \InvalidArgumentException('delete_all_after_expire_hours must be >= -1');
        }

        $this->delete_all_after_expire_hours = $delete_all_after_expire_hours;

        return $this;
    }
}
