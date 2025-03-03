<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Media\Manifest;

trait CreateUpdateFunctionsTrait
{
    protected ?string $name = null;

    protected ?bool $is_default = null;

    protected ?int $start_at = null;

    protected ?int $end_at = null;

    /**
     * @var array<int>|null
     */
    protected ?array $files = null;

    protected ?int $package_id = null;

    public function name(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function default(?bool $is_default): static
    {
        $this->is_default = $is_default;

        return $this;
    }

    /**
     * @param  int|null  $time  Miliseconds
     * @return $this
     */
    public function startAt(?int $time): static
    {
        $this->start_at = $time;

        return $this;
    }

    /**
     * @param  int|null  $time  Miliseconds
     * @return $this
     */
    public function endAt(?int $time): static
    {
        $this->end_at = $time;

        return $this;
    }

    /**
     * @param  array<int>|null  $files
     * @return $this
     */
    public function files(?array $files): static
    {
        $this->files = $files;

        return $this;
    }

    public function packageId(?int $package_id): static
    {
        $this->package_id = $package_id;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    protected function prepareData(): array
    {
        $data = [];

        if ($this->name !== null) {
            $data['name'] = $this->name;
        }

        if ($this->is_default !== null) {
            $data['default'] = $this->is_default ? 1 : 0;
        }

        if ($this->start_at !== null) {
            $data['start_at'] = $this->start_at;
        }

        if ($this->end_at !== null) {
            $data['end_at'] = $this->end_at;
        }

        if ($this->files !== null) {
            $data['files'] = $this->files;
        }

        if ($this->package_id !== null) {
            $data['package_id'] = $this->package_id;
        }

        return $data;
    }
}
