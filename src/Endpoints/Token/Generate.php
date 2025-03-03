<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Token;

use Carbon\CarbonInterface;
use Newman\LaravelBackscreenApiClient\AbstractEndpoint;
use Newman\LaravelBackscreenApiClient\Contracts\EndpointContract;
use Newman\LaravelBackscreenApiClient\Endpoints\Token\Generate\ItemTypeEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Token\Generate\SubitemTypeEnum;
use Newman\LaravelBackscreenApiClient\Enums\HttpMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Token/Generate
 */
class Generate extends AbstractEndpoint implements EndpointContract
{
    /**
     * @var array<string>|null
     */
    protected ?array $allowed_countries = null;

    protected ?string $allowed_ip = null;

    protected string|int|CarbonInterface|null $expire_time = null;

    protected ?int $subitem_id = null;

    protected ?SubitemTypeEnum $subitem_type = null;

    public function __construct(protected int $item_id, protected ItemTypeEnum $item_type) {}

    /**
     * @param  array<string>|null  $countries
     * @return $this
     */
    public function allowedCountries(?array $countries): static
    {
        $this->allowed_countries = $countries;

        return $this;
    }

    public function allowedIp(?string $ip): static
    {
        $this->allowed_ip = $ip;

        return $this;
    }

    public function expireTime(string|int|CarbonInterface|null $expire_time): static
    {
        $this->expire_time = $expire_time;

        return $this;
    }

    public function subitemId(?int $subitem_id): static
    {
        $this->subitem_id = $subitem_id;

        return $this;
    }

    public function subitemType(?SubitemTypeEnum $subitem_type): static
    {
        $this->subitem_type = $subitem_type;

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
        return '/Token/Generate';
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $query = [
            'item_id' => $this->item_id,
            'item_type' => $this->item_type->value,
        ];

        if ($this->allowed_countries !== null) {
            $query['allowed_countries'] = implode(',', $this->allowed_countries);
        }

        if ($this->allowed_ip !== null) {
            $query['allowed_ip'] = $this->allowed_ip;
        }

        if ($this->expire_time !== null) {
            $query['expire_time'] = $this->expire_time instanceof CarbonInterface ? $this->expire_time->toDateTimeString() : $this->expire_time;
        }

        if ($this->subitem_id !== null) {
            $query['subitem_id'] = $this->subitem_id;
        }

        if ($this->subitem_type !== null) {
            $query['subitem_type'] = $this->subitem_type->value;
        }

        $http->withQuery($query);
    }
}
