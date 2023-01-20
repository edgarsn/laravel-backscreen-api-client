<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Media\Manifest;

use Newman\LaravelTmsApiClient\AbstractEndpoint;
use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Endpoints\Media\Manifest\List\OrderByEnum;
use Newman\LaravelTmsApiClient\EndpointSupport\Enums\OrderDirectionEnum;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Media/Manifest/List
 */
class ManifestList extends AbstractEndpoint implements EndpointContract
{
    /**
     * @var array<int>|null
     */
    protected ?array $ids = null;

    protected ?int $limit = null;

    /**
     * @var array<int>|null
     */
    protected ?array $media_ids = null;

    protected ?int $offset = null;

    protected ?OrderByEnum $order_by = null;

    protected ?OrderDirectionEnum $order_dir = null;

    /**
     * @param array<int>|null $ids
     * @return $this
     */
    public function ids(?array $ids): static
    {
        $this->ids = $ids;

        return $this;
    }

    public function limit(?int $limit): static
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @param array<int>|null $ids
     * @return $this
     */
    public function mediaIds(?array $ids): static
    {
        $this->media_ids = $ids;

        return $this;
    }

    public function offset(?int $offset): static
    {
        $this->offset = $offset;

        return $this;
    }

    public function orderBy(?OrderByEnum $order_by): static
    {
        $this->order_by = $order_by;

        return $this;
    }

    public function orderDir(?OrderDirectionEnum $order_dir): static
    {
        $this->order_dir = $order_dir;

        return $this;
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
        return '/Media/Manifest/List';
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

        if ($this->ids !== null) {
            $query['id'] = $this->ids;
        }

        if ($this->limit !== null) {
            $query['limit'] = $this->limit;
        }

        if ($this->media_ids !== null) {
            $query['media_id'] = $this->media_ids;
        }

        if ($this->offset !== null) {
            $query['offset'] = $this->offset;
        }

        if ($this->order_by !== null) {
            $query['order_by'] = $this->order_by->value;
        }

        if ($this->order_dir !== null) {
            $query['order_dir'] = $this->order_dir->value;
        }

        $http->withQuery($query);
    }
}
