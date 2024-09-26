<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Live;

use Newman\LaravelTmsApiClient\AbstractEndpoint;
use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Live/Record
 */
class Record extends AbstractEndpoint implements EndpointContract
{
    protected int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function id(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * HTTP Method to use for request.
     *
     * @return HttpMethodEnum
     */
    public function useHttpMethod(): HttpMethodEnum
    {
        return HttpMethodEnum::PUT;
    }

    /**
     * Endpoint url.
     *
     * @return string
     */
    public function endpointUrl(): string
    {
        return '/Live/Record';
    }

    /**
     * Prepares HTTP request for this endpoint.
     *
     * @param PendingRequest $http
     * @return void
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $query = [];

        $query['id'] = $this->id;

        $http->withData($query);
    }
}