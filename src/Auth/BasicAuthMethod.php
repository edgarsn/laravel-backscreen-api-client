<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Auth;

use Newman\LaravelBackscreenApiClient\Contracts\AuthMethodContract;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

class BasicAuthMethod implements AuthMethodContract
{
    public function __construct(private string $username, private string $password) {}

    public function applyCredentials(PendingRequest $request): void
    {
        $request->withBasicAuth($this->username, $this->password);
    }

    public function getAuthMethod(): AuthMethodEnum
    {
        return AuthMethodEnum::BASIC;
    }
}
