<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Media;

use Newman\LaravelTmsApiClient\AbstractEndpoint;
use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Media/Generateimage
 */
class GenerateImage extends AbstractEndpoint implements EndpointContract
{
    protected ?int $media_file_id = null;

    protected ?string $thumbnail = null;

    protected ?string $placeholder = null;

    public function __construct(protected int $id)
    {

    }

    public function mediaFileId(?int $media_file_id): static
    {
        $this->media_file_id = $media_file_id;

        return $this;
    }

    public function thumbnail(?string $thumbnail): static
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function placeholder(?string $placeholder): static
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Define which authentication methods are allowed to call this endpoint.
     *
     * @return AuthMethodEnum[]
     */
    public function allowedAuthMethods(): array
    {
        return [AuthMethodEnum::BASIC, AuthMethodEnum::BEARER];
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
        return '/Media/Generateimage';
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
            'id' => $this->id,
        ];

        if ($this->media_file_id !== null) {
            $data['media_file_id'] = $this->media_file_id;
        }

        if ($this->thumbnail !== null) {
            $data['thumbnail'] = $this->thumbnail;
        }

        if ($this->placeholder !== null) {
            $data['placeholder'] = $this->placeholder;
        }

        $http->withData($data);
    }
}
