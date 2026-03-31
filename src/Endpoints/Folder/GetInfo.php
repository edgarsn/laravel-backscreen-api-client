<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder;

use Newman\LaravelBackscreenApiClient\AbstractEndpoint;
use Newman\LaravelBackscreenApiClient\Contracts\EndpointContract;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\GetInfo\ReturnEnum;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\Enums\HttpMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Folder/Getinfo
 */
class GetInfo extends AbstractEndpoint implements EndpointContract
{
    /**
     * @var array<ReturnEnum>|null
     */
    protected ?array $return = null;

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
     * What data to return. Available values: default_outgoing_patterns, multi_audio.
     *
     * @param  ReturnEnum|array<ReturnEnum>|null  $return
     */
    public function return(ReturnEnum|array|null $return): static
    {
        $this->return = $return === null ? null : (! \is_array($return) ? [$return] : $return);

        return $this;
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
        return '/Folder/Getinfo';
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $query = [];

        if ($this->return !== null) {
            $query['return'] = array_map(fn (ReturnEnum $r) => $r->value, $this->return);
        }

        $http->withQuery($query);
    }
}
