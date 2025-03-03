<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Live\Create\Recording;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class Recording
{
    use CompilesProperties;

    protected ?bool $auto_delete = null;

    protected ?bool $auto_delete_media = null;

    protected ?bool $save_passed = null;

    protected ?int $delete_after_hours = null;

    protected ?int $margin_start_seconds = null;

    protected ?int $margin_end_seconds = null;

    protected ?string $file_naming_pattern = null;

    protected ?Nimbus $nimbus = null;

    protected ?EPG $epg = null;

    public function autoDelete(bool $auto_delete): static
    {
        $this->auto_delete = $auto_delete;

        return $this;
    }

    public function autoDeleteMedia(bool $auto_delete_media): static
    {
        $this->auto_delete_media = $auto_delete_media;

        return $this;
    }

    public function savePassed(bool $save_passed): static
    {
        $this->save_passed = $save_passed;

        return $this;
    }

    public function deleteAfterHours(int $delete_after_hours): static
    {
        $this->delete_after_hours = $delete_after_hours;

        return $this;
    }

    public function marginStartSeconds(int $margin_start_seconds): static
    {
        $this->margin_start_seconds = $margin_start_seconds;

        return $this;
    }

    public function marginEndSeconds(int $margin_end_seconds): static
    {
        $this->margin_end_seconds = $margin_end_seconds;

        return $this;
    }

    public function fileNamingPattern(string $file_naming_pattern): static
    {
        $this->file_naming_pattern = $file_naming_pattern;

        return $this;
    }

    public function nimbus(Nimbus $nimbus): static
    {
        $this->nimbus = $nimbus;

        return $this;
    }

    public function epg(EPG $epg): static
    {
        $this->epg = $epg;

        return $this;
    }
}
