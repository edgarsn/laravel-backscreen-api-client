<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Enums\DuplicateActionEnum;

class Ingest
{
    use CompilesProperties;

    protected ?DuplicateActionEnum $duplicate_action = null;

    protected ?int $update_asset_name = null;

    protected ?int $use_tar_manifest = null;

    protected ?string $tar_manifest_file = null;

    protected ?string $subtitle_offset = null;

    /**
     * @var array<mixed>|null
     */
    protected ?array $patterns = null;

    public function duplicateAction(DuplicateActionEnum $duplicate_action): static
    {
        $this->duplicate_action = $duplicate_action;

        return $this;
    }

    public function updateAssetName(int $update_asset_name): static
    {
        if (! in_array($update_asset_name, [0, 1])) {
            throw new \InvalidArgumentException('update_asset_name must be 0 or 1');
        }

        $this->update_asset_name = $update_asset_name;

        return $this;
    }

    public function useTarManifest(int $use_tar_manifest): static
    {
        if (! in_array($use_tar_manifest, [0, 1])) {
            throw new \InvalidArgumentException('use_tar_manifest must be 0 or 1');
        }

        $this->use_tar_manifest = $use_tar_manifest;

        return $this;
    }

    public function tarManifestFile(string $tar_manifest_file): static
    {
        $this->tar_manifest_file = $tar_manifest_file;

        return $this;
    }

    /**
     * Must match pattern hh:mm:ss.
     */
    public function subtitleOffset(string $subtitle_offset): static
    {
        if (! preg_match('/^(\d{2}:\d{2}:\d{2})$/', $subtitle_offset)) {
            throw new \InvalidArgumentException('subtitle_offset must match hh:mm:ss format');
        }

        $this->subtitle_offset = $subtitle_offset;

        return $this;
    }

    /**
     * @param  array<mixed>  $patterns
     */
    public function patterns(array $patterns): static
    {
        $this->patterns = $patterns;

        return $this;
    }
}
