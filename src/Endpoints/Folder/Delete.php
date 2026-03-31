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
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Folder/Delete
 */
class Delete extends AbstractEndpoint implements EndpointContract
{
    public function __construct(protected int $id, protected TypeEnum $type) {}

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
     */
    public function useHttpMethod(): HttpMethodEnum
    {
        return HttpMethodEnum::DELETE;
    }

    /**
     * Endpoint url.
     */
    public function endpointUrl(): string
    {
        return '/Folder/Delete';
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $http->withQuery([
            'id' => $this->id,
            'type' => $this->type->value,
        ]);
    }
}
