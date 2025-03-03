<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient;

use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

abstract class AbstractEndpoint
{
    /**
     * Define which authentication methods are allowed to call this endpoint.
     *
     * @return AuthMethodEnum[]
     */
    public function allowedAuthMethods(): array
    {
        return [AuthMethodEnum::BASIC, AuthMethodEnum::BEARER, AuthMethodEnum::API_KEY];
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void {}
}
