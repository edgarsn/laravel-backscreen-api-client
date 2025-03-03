<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\HttpClient;

use Newman\LaravelBackscreenApiClient\Enums\HttpMethodEnum;

class PendingRequest extends \Illuminate\Http\Client\PendingRequest
{
    private HttpMethodEnum $tmsHttpMethod = HttpMethodEnum::GET;

    private string $tmsEndpoint;

    /**
     * @var array<string, mixed>
     */
    private array $tmsAuthQueryParams = [];

    /**
     * @var array<string, mixed>
     */
    private array $tmsQuery = [];

    /**
     * @var array<string, mixed>
     */
    private array $tmsData = [];

    /**
     * Specifies HTTP method to use.
     *
     * @return $this
     */
    public function useMethod(HttpMethodEnum $httpMethod): static
    {
        $this->tmsHttpMethod = $httpMethod;

        return $this;
    }

    /**
     * Endpoint to call, e.g. "/token/generate".
     *
     * @return $this
     */
    public function setEndpoint(string $endpoint): static
    {
        $this->tmsEndpoint = $endpoint;

        return $this;
    }

    /**
     * Specify authentication query parameters. Should only be used from AuthMethod implementation.
     *
     * @param  array<string, mixed>  $query
     * @return $this
     */
    public function setAuthQueryParams(array $query): static
    {
        $this->tmsAuthQueryParams = $query;

        return $this;
    }

    /**
     * Add optional query parameters to request.
     *
     * @param  array<string, mixed>  $query
     * @return $this
     */
    public function withQuery(array $query): static
    {
        $this->tmsQuery = $query;

        return $this;
    }

    /**
     * Data to POST/PUT/DELETE.
     *
     * @param  array<string, mixed>  $data
     * @return $this
     */
    public function withData(array $data): static
    {
        $this->tmsData = $data;

        return $this;
    }

    /**
     * Retrieve HTTP method to use.
     */
    public function getHttpMethod(): HttpMethodEnum
    {
        return $this->tmsHttpMethod;
    }

    /**
     * Retrieve Endpoint to call, e.g. "/token/generate"
     */
    public function getEndpoint(): string
    {
        return $this->tmsEndpoint;
    }

    /**
     * Compiles and returns merged query params.
     *
     * @return array<string, mixed>
     */
    public function getCompiledQuery(): array
    {
        return array_merge($this->tmsAuthQueryParams, $this->tmsQuery);
    }

    /**
     * Retrieve data to POST/PUT/DELETE.
     *
     * @return array<string, mixed>
     */
    public function getData(): array
    {
        return $this->tmsData;
    }

    /**
     * Get body format used for this request.
     *
     * @codeCoverageIgnore
     */
    public function getBodyFormat(): string
    {
        return $this->bodyFormat;
    }
}
