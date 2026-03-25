<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Update;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Tags as BaseTags;

class Tags extends BaseTags
{
    /**
     * @var array<string>|null
     */
    protected ?array $remove = null;

    /**
     * @param  array<string>  $remove
     */
    public function remove(array $remove): static
    {
        $this->remove = $remove;

        return $this;
    }
}
