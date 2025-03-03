<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Live;

use Newman\LaravelTmsApiClient\AbstractEndpoint;
use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Availability;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Embed;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Input\Input;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Publish;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Recording\Recording;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Security;
use Newman\LaravelTmsApiClient\EndpointSupport\Images;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

/**
 * @link https://api.cloudycdn.services/api/v5/docs#/operations/Live/Create
 */
class Create extends AbstractEndpoint implements EndpointContract
{
    protected string $name;

    protected ?int $cat_id = null;

    protected ?bool $multi_languages = null;

    protected ?string $custom_origin = null;

    protected ?Publish $publish = null;

    protected ?int $embed_player_id = null;

    protected ?int $embed_ad_id = null;

    protected ?int $embed_protection_id = null;

    protected ?Embed $embed = null;

    protected ?Security $security = null;

    protected ?Recording $recording = null;

    protected ?Images $images = null;

    protected ?Availability $availability = null;

    protected ?Input $input = null;

    protected ?string $timezone = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return $this
     */
    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return $this
     */
    public function catId(?int $cat_id): self
    {
        $this->cat_id = $cat_id;

        return $this;
    }

    /**
     * @return $this
     */
    public function multiLanguages(?bool $multi_languages): self
    {
        $this->multi_languages = $multi_languages;

        return $this;
    }

    /**
     * @return $this
     */
    public function customOrigin(?string $custom_origin): self
    {
        $this->custom_origin = $custom_origin;

        return $this;
    }

    /**
     * @return $this
     */
    public function publish(?Publish $publish): self
    {
        $this->publish = $publish;

        return $this;
    }

    /**
     * @return $this
     */
    public function embedPlayerId(?int $embed_player_id): self
    {
        $this->embed_player_id = $embed_player_id;

        return $this;
    }

    /**
     * @return $this
     */
    public function embedAdId(?int $embed_ad_id): self
    {
        $this->embed_ad_id = $embed_ad_id;

        return $this;
    }

    /**
     * @return $this
     */
    public function embedProtectionId(?int $embed_protection_id): self
    {
        $this->embed_protection_id = $embed_protection_id;

        return $this;
    }

    /**
     * @return $this
     */
    public function embed(?Embed $embed): self
    {
        $this->embed = $embed;

        return $this;
    }

    /**
     * @return $this
     */
    public function security(?Security $security): self
    {
        $this->security = $security;

        return $this;
    }

    /**
     * @return $this
     */
    public function recording(?Recording $recording): self
    {
        $this->recording = $recording;

        return $this;
    }

    /**
     * @return $this
     */
    public function images(?Images $images): self
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @return $this
     */
    public function availability(?Availability $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    /**
     * @return $this
     */
    public function input(?Input $input): self
    {
        $this->input = $input;

        return $this;
    }

    /**
     * @return $this
     */
    public function timezone(?string $timezone): self
    {
        $this->timezone = $timezone;

        return $this;
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
        return '/Live/Create';
    }

    /**
     * Prepares HTTP request for this endpoint.
     */
    public function prepareHttpRequest(PendingRequest $http): void
    {
        $query = [];

        $query['name'] = $this->name;

        if ($this->cat_id !== null) {
            $query['cat_id'] = $this->cat_id;
        }

        if ($this->multi_languages !== null) {
            $query['multi_languages'] = $this->multi_languages ? 1 : 0;
        }

        if ($this->custom_origin !== null) {
            $query['custom_origin'] = $this->custom_origin;
        }

        if ($this->publish !== null) {
            $publish = $this->publish->compileAsArray();

            if (! empty($publish)) {
                $query['publish'] = $publish;
            }
        }

        if ($this->embed_player_id !== null) {
            $query['embed_player_id'] = $this->embed_player_id;
        }

        if ($this->embed_ad_id !== null) {
            $query['embed_ad_id'] = $this->embed_ad_id;
        }

        if ($this->embed_protection_id !== null) {
            $query['embed_protection_id'] = $this->embed_protection_id;
        }

        if ($this->embed !== null) {
            $embed = $this->embed->compileAsArray();

            if (! empty($embed)) {
                $query['embed'] = $embed;
            }
        }

        if ($this->security !== null) {
            $security = $this->security->compileAsArray();

            if (! empty($security)) {
                $query['security'] = $security;
            }
        }

        if ($this->recording !== null) {
            $recording = $this->recording->compileAsArray();

            if (! empty($recording)) {
                $query['recording'] = $recording;
            }
        }

        if ($this->images !== null) {
            $images = $this->images->compileAsArray();

            if (! empty($images)) {
                $query['images'] = $images;
            }
        }

        if ($this->availability !== null) {
            $availability = $this->availability->compileAsArray();

            if (! empty($availability)) {
                $query['availability'] = $availability;
            }
        }

        if ($this->input !== null) {
            $input = $this->input->compileAsArray();

            if (! empty($input)) {
                $query['input'] = $input;
            }
        }

        if ($this->timezone !== null) {
            $query['timezone'] = $this->timezone;
        }

        $http->withData($query);
    }
}
