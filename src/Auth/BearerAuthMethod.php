<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Auth;

use Newman\LaravelBackscreenApiClient\Contracts\AuthMethodContract;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

class BearerAuthMethod implements AuthMethodContract
{
    public function __construct(private string $bearerToken) {}

    public function applyCredentials(PendingRequest $request): void
    {
        $request->withToken($this->bearerToken);
    }

    public function getAuthMethod(): AuthMethodEnum
    {
        return AuthMethodEnum::BEARER;
    }
}
