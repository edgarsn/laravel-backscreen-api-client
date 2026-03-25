<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media;

use Newman\LaravelBackscreenApiClient\AbstractEndpoint;
use Newman\LaravelBackscreenApiClient\Contracts\EndpointContract;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\Enums\HttpMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.backscreen.com/api/v5/docs#/operations/Media/Validate
 */
class Validate extends AbstractEndpoint implements EndpointContract
{
    protected ?int $transcode = null;

    protected ?int $transcode_priority = null;

    protected ?int $transcoding_preset_id = null;

    /**
     * @param  int|array<int>  $id
     */
    public function __construct(protected int|array $id) {}

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
     * Allowed values: 0 or 1.
     */
    public function transcode(int $transcode): static
    {
        if (! in_array($transcode, [0, 1])) {
            throw new \InvalidArgumentException('transcode must be 0 or 1');
        }

        $this->transcode = $transcode;

        return $this;
    }

    /**
     * Allowed values: 0 (normal priority) or 1 (top priority).
     */
    public function transcodePriority(int $transcode_priority): static
    {
        if (! in_array($transcode_priority, [0, 1])) {
            throw new \InvalidArgumentException('transcode_priority must be 0 or 1');
        }

        $this->transcode_priority = $transcode_priority;

        return $this;
    }

    public function transcodingPresetId(int $transcoding_preset_id): static
    {
        $this->transcoding_preset_id = $transcoding_preset_id;

        return $this;
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
        return '/Media/Validate';
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $data = [
            'id' => $this->id,
        ];

        if ($this->transcode !== null) {
            $data['transcode'] = $this->transcode;
        }

        if ($this->transcode_priority !== null) {
            $data['transcode_priority'] = $this->transcode_priority;
        }

        if ($this->transcoding_preset_id !== null) {
            $data['transcoding_preset_id'] = $this->transcoding_preset_id;
        }

        $http->withData($data);
    }
}
