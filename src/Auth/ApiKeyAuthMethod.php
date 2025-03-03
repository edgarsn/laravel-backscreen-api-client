<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Auth;

use Newman\LaravelTmsApiClient\Contracts\AuthMethodContract;
use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

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
