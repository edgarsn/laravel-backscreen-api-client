<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\User;

use Newman\LaravelTmsApiClient\AbstractEndpoint;
use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/User/Get
 */
class Get extends AbstractEndpoint implements EndpointContract
{

    /**
     * @var array<string>|null
     */
    protected ?array $return = null;

    public function __construct()
    {
    }

    /**
     * @param array<string>|null $return
     * @return $this
     */
    public function return(?array $return): static
    {
        $this->return = $return;

        return $this;
    }

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
        return HttpMethodEnum::GET;
    }

    /**
     * Endpoint url.
     *
     * @return string
     */
    public function endpointUrl(): string
    {
        return '/User/Get';
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

        if ($this->return !== null) {
            $query['return'] = $this->return;
        }

        $http->withQuery($query);
    }
}
