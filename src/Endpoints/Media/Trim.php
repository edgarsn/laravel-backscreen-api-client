<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media;

use Newman\LaravelBackscreenApiClient\AbstractEndpoint;
use Newman\LaravelBackscreenApiClient\Contracts\EndpointContract;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Trim\TypeEnum;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\Enums\HttpMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Media/Trim
 */
class Trim extends AbstractEndpoint implements EndpointContract
{
    protected ?string $name = null;

    /**
     * @param  string  $start  HH:mm:ss
     * @param  string  $end  HH:mm:ss
     */
    public function __construct(protected int $id, protected string $start, protected string $end, protected TypeEnum $type) {}

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
        return '/Media/Trim';
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $data = [
            'id' => $this->id,
            'start' => $this->start,
            'end' => $this->end,
            'type' => $this->type->value,
        ];

        if ($this->name !== null) {
            $data['name'] = $this->name;
        }

        $http->withData($data);
    }
}
