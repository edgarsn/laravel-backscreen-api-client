<?php

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Concerns\CompilesProperties;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\EncryptionMethodEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\TokenDurationEnum;

class Security
{
    use CompilesProperties;

    protected ?EncryptionMethodEnum $encryption_method = null;

    protected ?TokenDurationEnum $token_duration = null;

    protected ?int $use_token = null;

    protected ?int $use_token_full = null;

    public function encryptionMethod(EncryptionMethodEnum $encryption_method): static
    {
        $this->encryption_method = $encryption_method;

        return $this;
    }

    public function tokenDuration(TokenDurationEnum $token_duration): static
    {
        $this->token_duration = $token_duration;

        return $this;
    }

    public function useToken(int $use_token): static
    {
        if (! in_array($use_token, [0, 1])) {
            throw new \InvalidArgumentException('use_token must be 0 or 1');
        }

        $this->use_token = $use_token;

        return $this;
    }

    public function useTokenFull(int $use_token_full): static
    {
        if (! in_array($use_token_full, [0, 1])) {
            throw new \InvalidArgumentException('use_token_full must be 0 or 1');
        }

        $this->use_token_full = $use_token_full;

        return $this;
    }
}
