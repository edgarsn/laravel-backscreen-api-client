<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Live;

use Carbon\CarbonInterface;
use Newman\LaravelTmsApiClient\AbstractEndpoint;
use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Endpoints\Live\LiveList\OrderByEnum;
use Newman\LaravelTmsApiClient\Endpoints\Live\LiveList\PeriodEnum;
use Newman\LaravelTmsApiClient\Endpoints\Live\LiveList\ReturnEnum;
use Newman\LaravelTmsApiClient\EndpointSupport\Enums\OrderDirectionEnum;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Live/List
 */
class LiveList extends AbstractEndpoint implements EndpointContract
{
    protected string|int|CarbonInterface|null $created_from = null;
    protected ?PeriodEnum $created_period = null;
    protected string|int|CarbonInterface|null $created_to = null;
    /**
     * @var string|int|array<int>|null
     */
    protected string|int|array|null $id = null;
    protected ?int $id_from = null;
    protected ?int $id_to = null;
    protected ?bool $images_fallback = null;
    protected ?int $limit = null;
    protected ?string $name = null;
    protected ?int $offset = null;
    protected ?OrderByEnum $order_by = null;
    protected ?OrderDirectionEnum $order_dir = null;
    /**
     *  @var array<ReturnEnum>|ReturnEnum|null
     */
    protected array|ReturnEnum|null $return = null;
    protected string|int|CarbonInterface|null $updated_from = null;
    protected ?PeriodEnum $updated_period = null;
    protected string|int|CarbonInterface|null $updated_to = null;

    /**
     * @param string|int|CarbonInterface|null $created_from
     * @return $this
     */
    public function createdFrom(string|int|CarbonInterface|null $created_from): self
    {
        $this->created_from = $created_from;
        return $this;
    }

    /**
     * @param PeriodEnum|null $created_period
     * @return $this
     */
    public function createdPeriod(?PeriodEnum $created_period): self
    {
        $this->created_period = $created_period;
        return $this;
    }

    /**
     * @param string|int|CarbonInterface|null $created_to
     * @return $this
     */
    public function createdTo(string|int|CarbonInterface|null $created_to): self
    {
        $this->created_to = $created_to;
        return $this;
    }

    /**
     * @param string|int|array<int>|null $id
     * @return $this
     */
    public function id(string|int|array|null $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param int|null $id_from
     * @return $this
     */
    public function idFrom(?int $id_from): self
    {
        $this->id_from = $id_from;
        return $this;
    }

    /**
     * @param int|null $id_to
     * @return $this
     */
    public function idTo(?int $id_to): self
    {
        $this->id_to = $id_to;
        return $this;
    }

    /**
     * @param ?bool $images_fallback
     * @return $this
     */
    public function imagesFallback(?bool $images_fallback): self
    {
        $this->images_fallback = $images_fallback;
        return $this;
    }

    /**
     * @param int|null $limit
     * @return $this
     */
    public function limit(?int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function name(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param int|null $offset
     * @return $this
     */
    public function offset(?int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @param OrderByEnum|null $order_by
     * @return $this
     */
    public function orderBy(?OrderByEnum $order_by): self
    {
        $this->order_by = $order_by;
        return $this;
    }

    /**
     * @param OrderDirectionEnum|null $order_dir
     * @return $this
     */
    public function orderDir(?OrderDirectionEnum $order_dir): self
    {
        $this->order_dir = $order_dir;
        return $this;
    }

    /**
     * @param array<ReturnEnum>|ReturnEnum|null $return
     * @return $this
     */
    public function return(array|ReturnEnum|null $return): self
    {
        $this->return = $return;
        return $this;
    }

    /**
     * @param string|int|CarbonInterface|null $updated_from
     * @return $this
     */
    public function updatedFrom(string|int|CarbonInterface|null $updated_from): self
    {
        $this->updated_from = $updated_from;
        return $this;
    }

    /**
     * @param PeriodEnum|null $updated_period
     * @return $this
     */
    public function updatedPeriod(?PeriodEnum $updated_period): self
    {
        $this->updated_period = $updated_period;
        return $this;
    }

    /**
     * @param string|int|CarbonInterface|null $updated_to
     * @return $this
     */
    public function updatedTo(string|int|CarbonInterface|null $updated_to): self
    {
        $this->updated_to = $updated_to;
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
        return '/Live/List';
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

        if ($this->created_from !== null) {
            $query['created_from'] = $this->created_from instanceof CarbonInterface ? $this->created_from->toDateTimeString() : $this->created_from;
        }

        if ($this->created_period !== null) {
            $query['created_period'] = $this->created_period->value;
        }

        if ($this->created_to !== null) {
            $query['created_to'] = $this->created_to instanceof CarbonInterface ? $this->created_to->toDateTimeString() : $this->created_to;
        }

        if ($this->id !== null) {
            $query['id'] = $this->id;
        }

        if ($this->id_from !== null) {
            $query['id_from'] = $this->id_from;
        }

        if ($this->id_to !== null) {
            $query['id_to'] = $this->id_to;
        }

        if ($this->images_fallback !== null) {
            $query['images_fallback'] = $this->images_fallback ? 1 : 0;
        }

        if ($this->limit !== null) {
            $query['limit'] = $this->limit;
        }

        if ($this->name !== null) {
            $query['name'] = $this->name;
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

        if ($this->return !== null) {
            if (is_array($this->return)) {
                $query['return'] = array_map(fn(ReturnEnum $value) => $value->value, $this->return);
            } else {
                $query['return'] = $this->return->value;
            }
        }

        if ($this->updated_from !== null) {
            $query['updated_from'] = $this->updated_from instanceof CarbonInterface ? $this->updated_from->toDateTimeString() : $this->updated_from;
        }

        if ($this->updated_period !== null) {
            $query['updated_period'] = $this->updated_period->value;
        }

        if ($this->updated_to !== null) {
            $query['updated_to'] = $this->updated_to instanceof CarbonInterface ? $this->updated_to->toDateTimeString() : $this->updated_to;
        }

        $http->withQuery($query);
    }
}