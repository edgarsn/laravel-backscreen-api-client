<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Contracts;

use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\Enums\HttpMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

interface EndpointContract
{
    /**
     * Define which authentication methods are allowed to call this endpoint.
     *
     * @return AuthMethodEnum[]
     */
    public function allowedAuthMethods(): array;

    /**
     * HTTP Method to use for request.
     */
    public function useHttpMethod(): HttpMethodEnum;

    /**
     * Endpoint url.
     */
    public function endpointUrl(): string;

    /**
     * Prepares request specific to this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void;
}
