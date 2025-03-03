<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Live;

use Newman\LaravelBackscreenApiClient\AbstractEndpoint;
use Newman\LaravelBackscreenApiClient\Contracts\EndpointContract;
use Newman\LaravelBackscreenApiClient\Enums\HttpMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Live/Delete
 */
class Delete extends AbstractEndpoint implements EndpointContract
{
    protected int $id;

    protected ?bool $delete_media = null;

    protected ?bool $force = null;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return $this
     */
    public function id(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return $this
     */
    public function deleteMedia(?bool $delete_media): static
    {
        $this->delete_media = $delete_media;

        return $this;
    }

    /**
     * @return $this
     */
    public function force(?bool $force): static
    {
        $this->force = $force;

        return $this;
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
        return '/Live/Delete';
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $query = [];

        $query['id'] = $this->id;

        if ($this->delete_media !== null) {
            $query['delete_media'] = $this->delete_media ? 1 : 0;
        }

        if ($this->force !== null) {
            $query['force'] = $this->force ? 1 : 0;
        }

        $http->withData($query);
    }
}
