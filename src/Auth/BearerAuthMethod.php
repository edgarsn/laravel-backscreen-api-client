<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Auth;

use Newman\LaravelTmsApiClient\Contracts\AuthMethodContract;
use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

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
