<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class Availability
{
    use CompilesProperties;

    protected ?int $published = null;

    protected ?int $expire_hours = null;

    protected ?int $available_hours = null;

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
     * Must be >= -1. Use -1 to disable.
     */
    public function expireHours(int $expire_hours): static
    {
        if ($expire_hours < -1) {
            throw new \InvalidArgumentException('expire_hours must be >= -1');
        }

        $this->expire_hours = $expire_hours;

        return $this;
    }

    /**
     * Must be >= -1. Use -1 to disable.
     */
    public function availableHours(int $available_hours): static
    {
        if ($available_hours < -1) {
            throw new \InvalidArgumentException('available_hours must be >= -1');
        }

        $this->available_hours = $available_hours;

        return $this;
    }

    /**
     * Must be >= -1. Use -1 to disable.
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
     * Must be >= -1. Use -1 to disable.
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
     * Must be >= -1. Use -1 to disable.
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
     * Must be >= -1. Use -1 to disable.
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
     * Must be >= -1. Use -1 to disable.
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
