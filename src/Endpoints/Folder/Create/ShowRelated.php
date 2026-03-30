<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Enums\ShowRelatedTypeEnum;

class ShowRelated
{
    use CompilesProperties;

    protected ?ShowRelatedTypeEnum $type = null;

    protected ?int $limit = null;

    protected ?int $group_id = null;

    public function type(ShowRelatedTypeEnum $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Allowed values: 1–6.
     */
    public function limit(int $limit): static
    {
        if ($limit < 1 || $limit > 6) {
            throw new \InvalidArgumentException('limit must be between 1 and 6');
        }

        $this->limit = $limit;

        return $this;
    }

    /**
     * Must be >= 0.
     */
    public function groupId(int $group_id): static
    {
        if ($group_id < 0) {
            throw new \InvalidArgumentException('group_id must be >= 0');
        }

        $this->group_id = $group_id;

        return $this;
    }
}
