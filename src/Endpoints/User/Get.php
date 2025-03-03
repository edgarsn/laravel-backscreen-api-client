<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\User;

use Newman\LaravelBackscreenApiClient\AbstractEndpoint;
use Newman\LaravelBackscreenApiClient\Contracts\EndpointContract;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\Enums\HttpMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/User/Get
 */
class Get extends AbstractEndpoint implements EndpointContract
{
    /**
     * @var array<string>|null
     */
    protected ?array $return = null;

    public function __construct() {}

    /**
     * @param  array<string>|null  $return
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
        return '/User/Get';
    }

    /**
     * Prepares HTTP request for this endpoint.
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
