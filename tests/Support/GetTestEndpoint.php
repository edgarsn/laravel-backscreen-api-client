<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Support;

use Newman\LaravelTmsApiClient\AbstractEndpoint;
use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

class GetTestEndpoint extends AbstractEndpoint implements EndpointContract
{
    /**
     * HTTP Method to use for request.
     */
    public function useHttpMethod(): HttpMethodEnum
    {
        return HttpMethodEnum::GET;
    }

    /**
     * Endpoint url.
     */
    public function endpointUrl(): string
    {
        return '/Test';
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $http->withQuery(['status' => 'ingested']);
    }
}
