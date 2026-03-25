<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media;

use Carbon\CarbonInterface;
use Newman\LaravelBackscreenApiClient\AbstractEndpoint;
use Newman\LaravelBackscreenApiClient\Contracts\EndpointContract;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList\FileExtension;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList\MediaInfo;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList\OrderByEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList\PeriodEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList\Popular;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList\PublisherStatusEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList\StatusEnum;
use Newman\LaravelBackscreenApiClient\EndpointSupport\Enums\OrderDirectionEnum;
use Newman\LaravelBackscreenApiClient\Enums\HttpMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;
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

    protected ?int $id_from = null;

    protected ?int $id_to = null;

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

    protected ?PeriodEnum $created_period = null;

    protected string|int|CarbonInterface|null $updated_from = null;

    protected string|int|CarbonInterface|null $updated_to = null;

    protected ?PeriodEnum $updated_period = null;

    protected string|int|CarbonInterface|null $published_from = null;

    protected string|int|CarbonInterface|null $published_to = null;

    protected ?PeriodEnum $published_period = null;

    protected ?bool $published = null;

    protected ?PublisherStatusEnum $publisher_status = null;

    protected ?bool $only_available = null;

    /**
     * Wildcard. Can also be an array of string wildcards.
     *
     * @var array<string>|string|null
     */
    protected array|string|null $name = null;

    protected ?string $pg_rating = null;

    protected ?string $search = null;

    /**
     * @var array<StatusEnum>|null
     */
    protected ?array $status = null;

    /**
     * @var array<StatusEnum>|null
     */
    protected ?array $status_exclude = null;

    /**
     * Available values: warning, error, transcoded, multi_bitrate, published, expired, scheduled.
     *
     * @var array<string>|null
     */
    protected ?array $tech_status = null;

    /**
     * Available values: warning, error, transcoded, multi_bitrate, published, expired, scheduled.
     *
     * @var array<string>|null
     */
    protected ?array $tech_status_exclude = null;

    /**
     * @var array<string>|null
     */
    protected ?array $tags = null;

    /**
     * Filter by errors/warnings. Requires search_index_ready.
     *
     * @var array<string>|null
     */
    protected ?array $errors_warnings = null;

    protected ?FileExtension $file_extension = null;

    protected ?MediaInfo $media_info = null;

    protected ?Popular $popular = null;

    protected ?int $limit = null;

    protected ?int $offset = null;

    protected ?OrderByEnum $order_by = null;

    protected ?OrderDirectionEnum $order_dir = null;

    /**
     * @var array<int>|null
     */
    protected ?array $order_specific = null;

    protected ?bool $images_fallback = null;

    /**
     * @var array<mixed>|null
     */
    protected ?array $metadata = null;

    /**
     * @var array<string>|null
     */
    protected ?array $return = null;

    protected ?string $timezone = null;

    /**
     * @param  array<int>|null  $ids
     */
    public function ids(?array $ids): static
    {
        $this->ids = $ids;

        return $this;
    }

    public function idFrom(?int $id_from): static
    {
        $this->id_from = $id_from;

        return $this;
    }

    public function idTo(?int $id_to): static
    {
        $this->id_to = $id_to;

        return $this;
    }

    /**
     * @param  array<string>|null  $asset_ids
     */
    public function assetIds(?array $asset_ids): static
    {
        $this->asset_ids = $asset_ids;

        return $this;
    }

    /**
     * @param  array<int>|null  $ids
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

    public function createdPeriod(?PeriodEnum $created_period): static
    {
        $this->created_period = $created_period;

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

    public function updatedPeriod(?PeriodEnum $updated_period): static
    {
        $this->updated_period = $updated_period;

        return $this;
    }

    public function publishedFrom(string|int|CarbonInterface|null $published_from): static
    {
        $this->published_from = $published_from;

        return $this;
    }

    public function publishedTo(string|int|CarbonInterface|null $published_to): static
    {
        $this->published_to = $published_to;

        return $this;
    }

    public function publishedPeriod(?PeriodEnum $published_period): static
    {
        $this->published_period = $published_period;

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

    /**
     * @param  array<string>|string|null  $name
     */
    public function name(array|string|null $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function pgRating(?string $pg_rating): static
    {
        $this->pg_rating = $pg_rating;

        return $this;
    }

    public function search(?string $phrase): static
    {
        $this->search = $phrase;

        return $this;
    }

    /**
     * @param  StatusEnum|array<StatusEnum>|null  $status
     */
    public function status(StatusEnum|array|null $status): static
    {
        $this->status = $status === null ? null : (! is_array($status) ? [$status] : $status);

        return $this;
    }

    /**
     * @param  StatusEnum|array<StatusEnum>|null  $status_exclude
     */
    public function statusExclude(StatusEnum|array|null $status_exclude): static
    {
        $this->status_exclude = $status_exclude === null ? null : (! is_array($status_exclude) ? [$status_exclude] : $status_exclude);

        return $this;
    }

    /**
     * Available values: warning, error, transcoded, multi_bitrate, published, expired, scheduled.
     *
     * @param  array<string>|null  $tech_status
     */
    public function techStatus(?array $tech_status): static
    {
        $this->tech_status = $tech_status;

        return $this;
    }

    /**
     * Available values: warning, error, transcoded, multi_bitrate, published, expired, scheduled.
     *
     * @param  array<string>|null  $tech_status_exclude
     */
    public function techStatusExclude(?array $tech_status_exclude): static
    {
        $this->tech_status_exclude = $tech_status_exclude;

        return $this;
    }

    /**
     * @param  array<string>|null  $tags
     */
    public function tags(?array $tags): static
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @param  array<string>|null  $errors_warnings
     */
    public function errorsWarnings(?array $errors_warnings): static
    {
        $this->errors_warnings = $errors_warnings;

        return $this;
    }

    public function fileExtension(?FileExtension $file_extension): static
    {
        $this->file_extension = $file_extension;

        return $this;
    }

    public function mediaInfo(?MediaInfo $media_info): static
    {
        $this->media_info = $media_info;

        return $this;
    }

    public function popular(?Popular $popular): static
    {
        $this->popular = $popular;

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

    /**
     * @param  array<int>|null  $order_specific
     */
    public function orderSpecific(?array $order_specific): static
    {
        $this->order_specific = $order_specific;

        return $this;
    }

    public function imagesFallback(?bool $fallback): static
    {
        $this->images_fallback = $fallback;

        return $this;
    }

    /**
     * @param  array<mixed>|null  $metadata
     */
    public function metadata(?array $metadata): static
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * @param  array<string>|null  $return
     */
    public function return(?array $return): static
    {
        $this->return = $return;

        return $this;
    }

    public function timezone(?string $timezone): static
    {
        $this->timezone = $timezone;

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

        if ($this->id_from !== null) {
            $query['id_from'] = $this->id_from;
        }

        if ($this->id_to !== null) {
            $query['id_to'] = $this->id_to;
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

        if ($this->created_period !== null) {
            $query['created_period'] = $this->created_period->value;
        }

        if ($this->updated_from !== null) {
            $query['updated_from'] = $this->updated_from instanceof CarbonInterface ? $this->updated_from->toDateTimeString() : $this->updated_from;
        }

        if ($this->updated_to !== null) {
            $query['updated_to'] = $this->updated_to instanceof CarbonInterface ? $this->updated_to->toDateTimeString() : $this->updated_to;
        }

        if ($this->updated_period !== null) {
            $query['updated_period'] = $this->updated_period->value;
        }

        if ($this->published_from !== null) {
            $query['published_from'] = $this->published_from instanceof CarbonInterface ? $this->published_from->toDateTimeString() : $this->published_from;
        }

        if ($this->published_to !== null) {
            $query['published_to'] = $this->published_to instanceof CarbonInterface ? $this->published_to->toDateTimeString() : $this->published_to;
        }

        if ($this->published_period !== null) {
            $query['published_period'] = $this->published_period->value;
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

        if ($this->name !== null) {
            $query['name'] = $this->name;
        }

        if ($this->pg_rating !== null) {
            $query['pg_rating'] = $this->pg_rating;
        }

        if ($this->search !== null) {
            $query['search'] = $this->search;
        }

        if ($this->status !== null) {
            $query['status'] = array_map(fn (StatusEnum $status) => $status->value, $this->status);
        }

        if ($this->status_exclude !== null) {
            $query['status_exclude'] = array_map(fn (StatusEnum $status) => $status->value, $this->status_exclude);
        }

        if ($this->tech_status !== null) {
            $query['tech_status'] = $this->tech_status;
        }

        if ($this->tech_status_exclude !== null) {
            $query['tech_status_exclude'] = $this->tech_status_exclude;
        }

        if ($this->tags !== null) {
            $query['tags'] = $this->tags;
        }

        if ($this->errors_warnings !== null) {
            $query['errors_warnings'] = $this->errors_warnings;
        }

        if ($this->file_extension !== null) {
            $file_extension = $this->file_extension->compileAsArray();

            if (! empty($file_extension)) {
                $query['file_extension'] = $file_extension;
            }
        }

        if ($this->media_info !== null) {
            $media_info = $this->media_info->compileAsArray();

            if (! empty($media_info)) {
                $query['media_info'] = $media_info;
            }
        }

        if ($this->popular !== null) {
            $popular = $this->popular->compileAsArray();

            if (! empty($popular)) {
                $query['popular'] = $popular;
            }
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

        if ($this->order_specific !== null) {
            $query['order_specific'] = $this->order_specific;
        }

        if ($this->images_fallback !== null) {
            $query['images_fallback'] = $this->images_fallback ? 1 : 0;
        }

        if ($this->metadata !== null) {
            $query['metadata'] = $this->metadata;
        }

        if ($this->return !== null) {
            $query['return'] = $this->return;
        }

        if ($this->timezone !== null) {
            $query['timezone'] = $this->timezone;
        }

        $http->withQuery($query);
    }
}
