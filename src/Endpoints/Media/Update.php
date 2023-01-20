<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Media;

use Newman\LaravelTmsApiClient\AbstractEndpoint;
use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Endpoints\Media\Update\ByContract;
use Newman\LaravelTmsApiClient\Endpoints\Media\Update\Images;
use Newman\LaravelTmsApiClient\EndpointSupport\Callback;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Media/Update
 */
class Update extends AbstractEndpoint implements EndpointContract
{

    protected ?string $name = null;

    protected ?string $description = null;

    protected ?Images $images = null;

    protected ?Callback $callback = null;

    public function __construct(protected ByContract $by)
    {
    }

    public function name(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function description(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function images(?Images $images): static
    {
        $this->images = $images;

        return $this;
    }

    public function callback(?Callback $callback): static
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * HTTP Method to use for request.
     *
     * @return HttpMethodEnum
     */
    public function useHttpMethod(): HttpMethodEnum
    {
        return HttpMethodEnum::PUT;
    }

    /**
     * Endpoint url.
     *
     * @return string
     */
    public function endpointUrl(): string
    {
        return '/Media/Update';
    }

    /**
     * Prepares HTTP request for this endpoint.
     *
     * @param PendingRequest $http
     * @return void
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $data = [
            $this->by->getFieldName() => $this->by->getValue(),
        ];

        if ($this->name !== null) {
            $data['name'] = $this->name;
        }

        if ($this->description !== null) {
            $data['description'] = $this->description;
        }

        if ($this->images !== null) {
            $images = $this->images->compileAsArray();

            if (!empty($images)) {
                $data['images'] = $images;
            }
        }

        if ($this->callback !== null) {
            $data['callback'] = $this->callback->compileAsArray();
        }

        $http->withData($data);
    }
}
