<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Folder;

use Newman\LaravelBackscreenApiClient\AbstractEndpoint;
use Newman\LaravelBackscreenApiClient\Contracts\EndpointContract;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\FolderList\TypeEnum;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\Enums\HttpMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Folder/List
 */
class FolderList extends AbstractEndpoint implements EndpointContract
{
    /**
     * @var array<TypeEnum>
     */
    protected array $type;

    /**
     * @param  TypeEnum|array<TypeEnum>  $type
     */
    public function __construct(TypeEnum|array $type)
    {
        $this->type = \is_array($type) ? $type : [$type];
    }

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
        return '/Folder/List';
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $http->withQuery([
            'type' => array_map(fn (TypeEnum $t) => $t->value, $this->type),
        ]);
    }
}
