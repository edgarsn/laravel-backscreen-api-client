<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Auth;

use Newman\LaravelTmsApiClient\Contracts\AuthMethodContract;
use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

class BasicAuthMethod implements AuthMethodContract
{
    public function __construct(private string $username, private string $password)
    {
    }

    public function applyCredentials(PendingRequest $request): void
    {
        $request->withBasicAuth($this->username, $this->password);
    }

    public function getAuthMethod(): AuthMethodEnum
    {
        return AuthMethodEnum::BASIC;
    }
}
