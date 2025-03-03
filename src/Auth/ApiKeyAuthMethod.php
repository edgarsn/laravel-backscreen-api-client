<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Auth;

use Newman\LaravelBackscreenApiClient\Contracts\AuthMethodContract;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

class ApiKeyAuthMethod implements AuthMethodContract
{
    public function __construct(private string $apiKey) {}

    public function applyCredentials(PendingRequest $request): void
    {
        $request->setAuthQueryParams(['paramauth' => $this->apiKey]);
    }

    public function getAuthMethod(): AuthMethodEnum
    {
        return AuthMethodEnum::API_KEY;
    }
}
