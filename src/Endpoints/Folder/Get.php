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
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Folder/Get
 */
class Get extends AbstractEndpoint implements EndpointContract
{
    protected ?int $id = null;

    protected ?int $parent_id = null;

    public function __construct(protected TypeEnum $type) {}

    public function id(?int $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * System ID of parent folder.
     */
    public function parentId(?int $parent_id): static
    {
        $this->parent_id = $parent_id;

        return $this;
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
        return '/Folder/Get';
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $query = [
            'type' => $this->type->value,
        ];

        if ($this->id !== null) {
            $query['id'] = $this->id;
        }

        if ($this->parent_id !== null) {
            $query['parent_id'] = $this->parent_id;
        }

        $http->withQuery($query);
    }
}
