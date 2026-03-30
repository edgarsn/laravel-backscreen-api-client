<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class ExternalUploads
{
    use CompilesProperties;

    protected ?int $upload_automatically = null;

    /**
     * @var array<mixed>|null
     */
    protected ?array $outputs = null;

    public function uploadAutomatically(int $upload_automatically): static
    {
        if (! in_array($upload_automatically, [0, 1])) {
            throw new \InvalidArgumentException('upload_automatically must be 0 or 1');
        }

        $this->upload_automatically = $upload_automatically;

        return $this;
    }

    /**
     * @param  array<mixed>  $outputs
     */
    public function outputs(array $outputs): static
    {
        $this->outputs = $outputs;

        return $this;
    }
}
