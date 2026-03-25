<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media;

use Newman\LaravelBackscreenApiClient\AbstractEndpoint;
use Newman\LaravelBackscreenApiClient\Contracts\EndpointContract;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Availability;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Embed;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Files;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Images;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Player;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Presentation;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Security;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Tags;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\TranscodeInfo;
use Newman\LaravelBackscreenApiClient\EndpointSupport\Images as LegacyImages;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\Enums\HttpMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

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

    protected ?TranscodeInfo $transcode_info = null;

    protected ?Images $images = null;

    protected ?Embed $embed = null;

    protected ?Presentation $presentation = null;

    protected ?Player $player = null;

    /** @var Files[]|null */
    protected ?array $files = null;

    protected ?Security $security = null;

    protected ?Availability $availability = null;

    /**
     * @var array<mixed>|null
     */
    protected ?array $metadata = null;

    protected ?string $timezone = null;

    protected ?Tags $tags = null;

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

    /**
     * Allowed values: 0 or 1.
     */
    public function autoTranscode(?int $auto_transcode): static
    {
        $this->auto_transcode = $auto_transcode;

        return $this;
    }

    /**
     * -1 = inherit, 0 = none, >0 = Specific ID
     */
    public function embedPlayerId(?int $embed_player_id): static
    {
        $this->embed_player_id = $embed_player_id;

        return $this;
    }

    /**
     * -1 = inherit, 0 = none, >0 = Specific ID
     */
    public function embedAdId(?int $embed_ad_id): static
    {
        $this->embed_ad_id = $embed_ad_id;

        return $this;
    }

    /**
     * -1 = inherit, 0 = none, >0 = Specific ID
     */
    public function embedProtectionId(?int $embed_protection_id): static
    {
        $this->embed_protection_id = $embed_protection_id;

        return $this;
    }

    public function transcodeInfo(?TranscodeInfo $transcode_info): static
    {
        $this->transcode_info = $transcode_info;

        return $this;
    }

    public function images(Images|LegacyImages|null $images): static
    {
        if ($images instanceof LegacyImages) {
            /** @var array{thumbnail?: string, placeholder?: string} $compiled */
            $compiled = $images->compileAsArray();
            $images = new Images;
            if (isset($compiled['thumbnail'])) {
                $images->thumbnail($compiled['thumbnail']);
            }
            if (isset($compiled['placeholder'])) {
                $images->placeholder($compiled['placeholder']);
            }
        }

        $this->images = $images;

        return $this;
    }

    public function embed(?Embed $embed): static
    {
        $this->embed = $embed;

        return $this;
    }

    public function presentation(?Presentation $presentation): static
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function player(?Player $player): static
    {
        $this->player = $player;

        return $this;
    }

    public function security(?Security $security): static
    {
        $this->security = $security;

        return $this;
    }

    public function availability(?Availability $availability): static
    {
        $this->availability = $availability;

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

        if ($this->transcode_info !== null) {
            $transcode_info = $this->transcode_info->compileAsArray();

            if (! empty($transcode_info)) {
                $data['transcode_info'] = $transcode_info;
            }
        }

        if ($this->images !== null) {
            $images = $this->images->compileAsArray();

            if (! empty($images)) {
                $data['images'] = $images;
            }
        }

        if ($this->embed !== null) {
            $embed = $this->embed->compileAsArray();

            if (! empty($embed)) {
                $data['embed'] = $embed;
            }
        }

        if ($this->presentation !== null) {
            $presentation = $this->presentation->compileAsArray();

            if (! empty($presentation)) {
                $data['presentation'] = $presentation;
            }
        }

        if ($this->player !== null) {
            $player = $this->player->compileAsArray();

            if (! empty($player)) {
                $data['player'] = $player;
            }
        }

        if ($this->security !== null) {
            $security = $this->security->compileAsArray();

            if (! empty($security)) {
                $data['security'] = $security;
            }
        }

        if ($this->availability !== null) {
            $availability = $this->availability->compileAsArray();

            if (! empty($availability)) {
                $data['availability'] = $availability;
            }
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

        $http->withData($data);
    }
}
