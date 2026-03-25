<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Update;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class UpdateManifest
{
    use CompilesProperties;

    protected ?int $id = null;

    protected ?int $start_at = null;

    protected ?int $end_at = null;

    protected ?MaterialChange $material_change = null;

    public function id(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function startAt(int $start_at): static
    {
        $this->start_at = $start_at;

        return $this;
    }

    public function endAt(int $end_at): static
    {
        $this->end_at = $end_at;

        return $this;
    }

    public function materialChange(MaterialChange $material_change): static
    {
        $this->material_change = $material_change;

        return $this;
    }
}
