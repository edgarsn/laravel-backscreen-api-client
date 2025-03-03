<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Media;

use Newman\LaravelTmsApiClient\AbstractEndpoint;
use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Endpoints\Media\Create\Files;
use Newman\LaravelTmsApiClient\Endpoints\Media\Create\Tags;
use Newman\LaravelTmsApiClient\EndpointSupport\Callback;
use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Media/Create
 */
class Create extends AbstractEndpoint implements EndpointContract
{
    protected string $asset_id;

    protected ?int $cat_id = null;

    protected ?string $name = null;

    protected ?string $description = null;

    protected ?string $pg_rating = null;

    protected ?int $auto_transcode = null;

    protected ?int $embed_player_id = null;

    protected ?int $embed_ad_id = null;

    protected ?int $embed_protection_id = null;

    /**
     * @var array<mixed>|null
     */
    protected ?array $metadata = null;

    protected ?string $timezone = null;

    /** @var Files[]|null */
    protected ?array $files = null;

    protected ?Tags $tags = null;

    /** @var Callback[]|null */
    protected ?array $callback = null;

    public function __construct(string $asset_id)
    {
        $this->asset_id = $asset_id;
    }

    public function assetId(string $asset_id): static
    {
        $this->asset_id = $asset_id;

        return $this;
    }

    public function catId(?int $cat_id): static
    {
        $this->cat_id = $cat_id;

        return $this;
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

    public function pgRating(?string $pg_rating): static
    {
        $this->pg_rating = $pg_rating;

        return $this;
    }

    public function autoTranscode(?int $auto_transcode): static
    {
        $this->auto_transcode = $auto_transcode;

        return $this;
    }

    public function embedPlayerId(?int $embed_player_id): static
    {
        $this->embed_player_id = $embed_player_id;

        return $this;
    }

    public function embedAdId(?int $embed_ad_id): static
    {
        $this->embed_ad_id = $embed_ad_id;

        return $this;
    }

    public function embedProtectionId(?int $embed_protection_id): static
    {
        $this->embed_protection_id = $embed_protection_id;

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

    public function timezone(?string $timezone): static
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * @param  Files[]|null  $files
     */
    public function files(?array $files): static
    {
        $this->files = $files;

        return $this;
    }

    public function tags(?Tags $tags): static
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @param  Callback[]|null  $callback
     */
    public function callback(?array $callback): static
    {
        $this->callback = $callback;

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
     */
    public function useHttpMethod(): HttpMethodEnum
    {
        return HttpMethodEnum::POST;
    }

    /**
     * Endpoint url.
     */
    public function endpointUrl(): string
    {
        return '/Media/Create';
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $data = [
            'asset_id' => $this->asset_id,
        ];

        if ($this->cat_id !== null) {
            $data['cat_id'] = $this->cat_id;
        }

        if ($this->name !== null) {
            $data['name'] = $this->name;
        }

        if ($this->description !== null) {
            $data['description'] = $this->description;
        }

        if ($this->pg_rating !== null) {
            $data['pg_rating'] = $this->pg_rating;
        }

        if ($this->auto_transcode !== null) {
            $data['auto_transcode'] = $this->auto_transcode;
        }

        if ($this->embed_player_id !== null) {
            $data['embed_player_id'] = $this->embed_player_id;
        }

        if ($this->embed_ad_id !== null) {
            $data['embed_ad_id'] = $this->embed_ad_id;
        }

        if ($this->embed_protection_id !== null) {
            $data['embed_protection_id'] = $this->embed_protection_id;
        }

        if ($this->metadata !== null) {
            $data['metadata'] = $this->metadata;
        }

        if ($this->timezone !== null) {
            $data['timezone'] = $this->timezone;
        }

        if ($this->files !== null) {
            $files = [];

            foreach ($this->files as $value) {
                $file = $value->compileAsArray();
                if (! empty($file)) {
                    $files[] = $file;
                }
            }

            if (! empty($files)) {
                $data['files'] = $files;
            }
        }

        if ($this->tags !== null) {
            $tags = $this->tags->compileAsArray();

            if (! empty($tags)) {
                $data['tags'] = $tags;
            }
        }

        if ($this->callback !== null) {
            $callbacks = [];

            foreach ($this->callback as $value) {
                $callback = $value->compileAsArray();
                if (! empty($callback)) {
                    $callbacks[] = $callback;
                }
            }

            if (! empty($callbacks)) {
                $data['callback'] = $callbacks;
            }
        }

        $http->withData($data);
    }
}
