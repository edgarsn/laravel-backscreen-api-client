<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Support;

use Newman\LaravelTmsApiClient\AbstractEndpoint;
use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

class PostTestBearerOnlyEndpoint extends AbstractEndpoint implements EndpointContract
{
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
     *
     * @return HttpMethodEnum
     */
    public function useHttpMethod(): HttpMethodEnum
    {
        return HttpMethodEnum::POST;
    }

    /**
     * Endpoint url.
     *
     * @return string
     */
    public function endpointUrl(): string
    {
        return '/Test/Create';
    }

    /**
     * Prepares HTTP request for this endpoint.
     *
     * @param PendingRequest $http
     * @return void
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $http->withData([
            'status' => 'publish',
        ]);
    }
}
