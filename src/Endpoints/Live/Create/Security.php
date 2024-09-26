<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Live\Create;

use Newman\LaravelTmsApiClient\Concerns\CompilesProperties;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Enums\EncryptionMethodEnum;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Enums\TokenDurationEnum;

class Security
{
    use CompilesProperties;

    protected ?EncryptionMethodEnum $encryption_method = null;
    protected ?bool $use_token = null;
    protected ?TokenDurationEnum $token_duration = null;

    public function encryptionMethod(EncryptionMethodEnum $encryption_method): static
    {
        $this->encryption_method = $encryption_method;

        return $this;
    }

    public function useToken(bool $use_token): static
    {
        $this->use_token = $use_token;

        return $this;
    }

    public function tokenDuration(TokenDurationEnum $token_duration): static
    {
        $this->token_duration = $token_duration;

        return $this;
    }
}