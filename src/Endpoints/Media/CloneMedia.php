<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Media;

use Newman\LaravelTmsApiClient\AbstractEndpoint;
use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Media/Clone
 */
class CloneMedia extends AbstractEndpoint implements EndpointContract
{
    protected ?string $name = null;

    public function __construct(protected int $media_id, protected string $asset_id) {}

    public function name(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Define which authentication methods are allowed to call this endpoint.
     *
     * @return AuthMethodEnum[]
     */
    public function allowedAuthMethods(): array
    {
        return [AuthMethodEnum::BEARER];
    }

    /**
     * HTTP Method to use for request.
     */
    public function useHttpMethod(): HttpMethodEnum
    {
        return HttpMethodEnum::PUT;
    }

    /**
     * Endpoint url.
     */
    public function endpointUrl(): string
    {
        return '/Media/Clone';
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $data = [
            'id' => $this->media_id,
            'asset_id' => $this->asset_id,
        ];

        if ($this->name !== null) {
            $data['name'] = $this->name;
        }

        $http->withData($data);
    }
}
