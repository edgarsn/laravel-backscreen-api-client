<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\UpdateMulti;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;

class UpdateItem
{
    use CompilesProperties;

    protected ?int $id = null;

    /**
     * @var array<UpdateItem>|null
     */
    protected ?array $children = null;

    /**
     * If provided, updates an existing folder with this ID.
     * If not provided, creates a new folder.
     */
    public function id(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param  array<UpdateItem>  $children
     */
    public function children(array $children): static
    {
        $this->children = $children;

        return $this;
    }
}
