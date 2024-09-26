<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Live;

use Newman\LaravelTmsApiClient\AbstractEndpoint;
use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

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
     * @param int $id
     * @return $this
     */
    public function id(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param ?bool $delete_media
     * @return $this
     */
    public function deleteMedia(?bool $delete_media): static
    {
        $this->delete_media = $delete_media;

        return $this;
    }

    /**
     * @param ?bool $force
     * @return $this
     */
    public function force(?bool $force): static
    {
        $this->force = $force;

        return $this;
    }

    /**
     * HTTP Method to use for request.
     *
     * @return HttpMethodEnum
     */
    public function useHttpMethod(): HttpMethodEnum
    {
        return HttpMethodEnum::DELETE;
    }

    /**
     * Endpoint url.
     *
     * @return string
     */
    public function endpointUrl(): string
    {
        return '/Live/Delete';
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

        if ($this->delete_media !== null) {
            $query['delete_media'] = $this->delete_media ? 1 : 0;
        }

        if ($this->force !== null) {
            $query['force'] = $this->force ? 1 : 0;
        }

        $http->withData($query);
    }
}