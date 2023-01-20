<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Media\Manifest;

use Newman\LaravelTmsApiClient\AbstractEndpoint;
use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Media/Manifest/Delete
 */
class Delete extends AbstractEndpoint implements EndpointContract
{

    public function __construct(protected int $id)
    {

    }

    /**
     * Define which authentication methods are allowed to call this endpoint.
     *
     * @return AuthMethodEnum[]
     */
    public function allowedAuthMethods(): array
    {
        return [AuthMethodEnum::BASIC, AuthMethodEnum::BEARER];
    }

    /**
     * HTTP Method to use for request.
     *
     * @return HttpMethodEnum
     */
    public function useHttpMethod(): HttpMethodEnum
    {
        return HttpMethodEnum::DELETE;
    }

    /**
     * Endpoint url.
     *
     * @return string
     */
    public function endpointUrl(): string
    {
        return '/Media/Manifest/Delete';
    }

    /**
     * Prepares HTTP request for this endpoint.
     *
     * @param PendingRequest $http
     * @return void
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $http->withData(['id' => $this->id]);
    }
}
