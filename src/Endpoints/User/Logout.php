<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\User;

use Newman\LaravelBackscreenApiClient\AbstractEndpoint;
use Newman\LaravelBackscreenApiClient\Contracts\EndpointContract;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\Enums\HttpMethodEnum;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/User/Logout
 */
class Logout extends AbstractEndpoint implements EndpointContract
{
    public function __construct() {}

    /**
     * Define which authentication methods are allowed to call this endpoint.
     *
     * @return AuthMethodEnum[]
     */
    public function allowedAuthMethods(): array
    {
        return [AuthMethodEnum::BEARER];
    }

    /**
     * HTTP Method to use for request.
     */
    public function useHttpMethod(): HttpMethodEnum
    {
        return HttpMethodEnum::POST;
    }

    /**
     * Endpoint url.
     */
    public function endpointUrl(): string
    {
        return '/User/Logout';
    }
}
