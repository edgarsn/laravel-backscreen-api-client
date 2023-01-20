<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Contracts;

use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

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
     *
     * @return HttpMethodEnum
     */
    public function useHttpMethod(): HttpMethodEnum;

    /**
     * Endpoint url.
     *
     * @return string
     */
    public function endpointUrl(): string;

    /**
     * Prepares request specific to this endpoint.
     *
     * @param PendingRequest $http
     * @return void
     */
    public function prepareHttpRequest(PendingRequest $http): void;
}
