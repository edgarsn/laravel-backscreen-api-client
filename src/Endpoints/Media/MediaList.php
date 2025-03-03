<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Media;

use Carbon\CarbonInterface;
use Newman\LaravelTmsApiClient\AbstractEndpoint;
use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Endpoints\Media\MediaList\OrderByEnum;
use Newman\LaravelTmsApiClient\Endpoints\Media\MediaList\PublisherStatusEnum;
use Newman\LaravelTmsApiClient\Endpoints\Media\MediaList\StatusEnum;
use Newman\LaravelTmsApiClient\EndpointSupport\Enums\OrderDirectionEnum;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;
use OutOfBoundsException;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Media/List
 */
class MediaList extends AbstractEndpoint implements EndpointContract
{
    /**
     * @var array<int>|null
     */
    protected ?array $ids = null;

    /**
     * @var array<string>|null
     */
    protected ?array $asset_ids = null;

    /**
     * @var array<int>|null
     */
    protected ?array $category_ids = null;

    protected string|int|CarbonInterface|null $created_from = null;

    protected string|int|CarbonInterface|null $created_to = null;

    protected string|int|CarbonInterface|null $updated_from = null;

    protected string|int|CarbonInterface|null $updated_to = null;

    protected ?bool $published = null;

    protected ?PublisherStatusEnum $publisher_status = null;

    protected ?bool $only_available = null;

    protected ?string $search = null;

    /**
     * @var array<StatusEnum>|null
     */
    protected ?array $status = null;

    /**
     * @var array<string>|null
     */
    protected ?array $tags = null;

    protected ?int $limit = null;

    protected ?int $offset = null;

    protected ?OrderByEnum $order_by = null;

    protected ?OrderDirectionEnum $order_dir = null;

    protected ?bool $images_fallback = null;

    /**
     * @var array<string>|null
     */
    protected ?array $return = null;

    /**
     * @param  array<int>|null  $ids
     * @return $this
     */
    public function ids(?array $ids): static
    {
        $this->ids = $ids;

        return $this;
    }

    /**
     * @param  array<string>|null  $asset_ids
     * @return $this
     */
    public function assetIds(?array $asset_ids): static
    {
        $this->asset_ids = $asset_ids;

        return $this;
    }

    /**
     * @param  array<int>|null  $ids
     * @return $this
     */
    public function categoryIds(?array $ids): static
    {
        $this->category_ids = $ids;

        return $this;
    }

    public function createdFrom(string|int|CarbonInterface|null $created_from): static
    {
        $this->created_from = $created_from;

        return $this;
    }

    public function createdTo(string|int|CarbonInterface|null $created_to): static
    {
        $this->created_to = $created_to;

        return $this;
    }

    public function updatedFrom(string|int|CarbonInterface|null $updated_from): static
    {
        $this->updated_from = $updated_from;

        return $this;
    }

    public function updatedTo(string|int|CarbonInterface|null $updated_to): static
    {
        $this->updated_to = $updated_to;

        return $this;
    }

    public function published(?bool $published): static
    {
        $this->published = $published;

        return $this;
    }

    public function publisherStatus(?PublisherStatusEnum $status): static
    {
        $this->publisher_status = $status;

        return $this;
    }

    public function onlyAvailable(?bool $only_available): static
    {
        $this->only_available = $only_available;

        return $this;
    }

    public function search(?string $phrase): static
    {
        $this->search = $phrase;

        return $this;
    }

    /**
     * @param  StatusEnum|array<StatusEnum>|null  $status
     * @return $this
     */
    public function status(StatusEnum|array|null $status): static
    {
        $this->status = $status === null ? null : (! is_array($status) ? [$status] : $status);

        return $this;
    }

    /**
     * @param  array<string>|null  $tags
     * @return $this
     */
    public function tags(?array $tags): static
    {
        $this->tags = $tags;

        return $this;
    }

    public function limit(?int $limit): static
    {
        if ($limit < 1 || $limit > 50) {
            throw new OutOfBoundsException('Limit must be between 1 and 50.');
        }

        $this->limit = $limit;

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

    public function imagesFallback(?bool $fallback): static
    {
        $this->images_fallback = $fallback;

        return $this;
    }

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
        return '/Media/List';
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $query = [];

        if ($this->ids !== null) {
            $query['id'] = $this->ids;
        }

        if ($this->asset_ids !== null) {
            $query['asset_id'] = $this->asset_ids;
        }

        if ($this->category_ids !== null) {
            $query['cat_id'] = $this->category_ids;
        }

        if ($this->created_from !== null) {
            $query['created_from'] = $this->created_from instanceof CarbonInterface ? $this->created_from->toDateTimeString() : $this->created_from;
        }

        if ($this->created_to !== null) {
            $query['created_to'] = $this->created_to instanceof CarbonInterface ? $this->created_to->toDateTimeString() : $this->created_to;
        }

        if ($this->updated_from !== null) {
            $query['updated_from'] = $this->updated_from instanceof CarbonInterface ? $this->updated_from->toDateTimeString() : $this->updated_from;
        }

        if ($this->updated_to !== null) {
            $query['updated_to'] = $this->updated_to instanceof CarbonInterface ? $this->updated_to->toDateTimeString() : $this->updated_to;
        }

        if ($this->published !== null) {
            $query['published'] = $this->published ? 1 : 0;
        }

        if ($this->publisher_status !== null) {
            $query['publisher_status'] = $this->publisher_status->value;
        }

        if ($this->only_available !== null) {
            $query['only_available'] = $this->only_available ? 1 : 0;
        }

        if ($this->search !== null) {
            $query['search'] = $this->search;
        }

        if ($this->status !== null) {
            $query['status'] = array_map(fn (StatusEnum $status) => $status->value, $this->status);
        }

        if ($this->tags !== null) {
            $query['tags'] = $this->tags;
        }

        if ($this->limit !== null) {
            $query['limit'] = $this->limit;
        }

        if ($this->offset != null) {
            $query['offset'] = $this->offset;
        }

        if ($this->order_by !== null) {
            $query['order_by'] = $this->order_by->value;
        }

        if ($this->order_dir !== null) {
            $query['order_dir'] = $this->order_dir->value;
        }

        if ($this->images_fallback !== null) {
            $query['images_fallback'] = $this->images_fallback ? 1 : 0;
        }

        if ($this->return !== null) {
            $query['return'] = $this->return;
        }

        $http->withQuery($query);
    }
}
