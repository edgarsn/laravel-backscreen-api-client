<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Live\Create\Input;

use Newman\LaravelTmsApiClient\Concerns\CompilesProperties;

class AudioLanguage
{
    use CompilesProperties;

    protected ?string $language = null;
    protected ?string $pid = null;
    protected ?string $language_name = null;

    public function language(string $language): static
    {
        if (strlen($language) !== 3) {
            throw new \InvalidArgumentException('language must be a 3 character string of ISO 639-2 language code');
        }

        $this->language = $language;

        return $this;
    }

    public function pid(string $pid): static
    {
        if (!preg_match('/^[a-zA-Z0-9]+$/', $pid)) {
            throw new \InvalidArgumentException('pid must be an alphanumeric string');
        }

        $this->pid = $pid;

        return $this;
    }

    public function languageName(string $language_name): static
    {
        $this->language_name = $language_name;

        return $this;
    }
}