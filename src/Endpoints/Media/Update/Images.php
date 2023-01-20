<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Media\Update;

use Newman\LaravelTmsApiClient\Concerns\CompilesProperties;

class Images
{
    use CompilesProperties;

    /**
     * @var string|null
     */
    protected $thumbnail = null;

    /**
     * @var string|null
     */
    protected $placeholder = null;

    /**
     * @var string|null
     */
    protected $playbutton = null;

    /**
     * @var string|null
     */
    protected $logo = null;

    public function thumbnail(?string $imageBase64): static
    {
        $this->thumbnail = $imageBase64;

        return $this;
    }

    public function placeholder(?string $imageBase64): static
    {
        $this->placeholder = $imageBase64;

        return $this;
    }

    public function playbutton(?string $imageBase64): static
    {
        $this->playbutton = $imageBase64;

        return $this;
    }

    public function logo(?string $imageBase64): static
    {
        $this->logo = $imageBase64;

        return $this;
    }
}
