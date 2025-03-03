<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient;

use Exception;
use Illuminate\Http\Client\Response;
use Newman\LaravelTmsApiClient\Contracts\AuthMethodContract;
use Newman\LaravelTmsApiClient\Contracts\ClientContract;
use Newman\LaravelTmsApiClient\Contracts\EndpointContract;
use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\Exceptions\TmsAuthMethodNotAllowed;
use Newman\LaravelTmsApiClient\HttpClient\HttpFactory;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

class Client implements ClientContract
{
    protected AuthMethodContract $auth;

    protected int $timeout = 15;

    protected int $connectTimeout = 15;

    /**
     * @var callable[]
     */
    protected array $middlewares = [];

    protected ?HttpFactory $httpFactory = null;

    public function __construct(AuthMethodContract $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Customize HTTP timeout for client.
     *
     * @return $this
     */
    public function timeout(int $seconds): static
    {
        $this->timeout = $seconds;

        return $this;
    }

    /**
     * Customize HTTP connect timeout for client.
     *
     * @return $this
     */
    public function connectTimeout(int $seconds): static
    {
        $this->connectTimeout = $seconds;

        return $this;
    }

    /**
     * Append HTTP Client middleware.
     *
     * @return $this
     */
    public function withMiddleware(callable $middleware): static
    {
        $this->middlewares[] = $middleware;

        return $this;
    }

    /**
     * Run Endpoint.
     *
     * @throws Exception
     */
    public function run(EndpointContract $endpoint): Response
    {
        if (! in_array($this->auth->getAuthMethod(), $endpoint->allowedAuthMethods())) {
            throw new TmsAuthMethodNotAllowed('This authentication method is not allowed to call given endpoint.');
        }

        $factory = $this->buildHttpFactory();
        $request = $this->buildBaseRequest($factory);

        $this->applyAuthCredentials($request);
        $this->applyHttpMiddleware($request);

        $this->applyEndpointDefaults($request, $endpoint);
        $endpoint->prepareHttpRequest($request);

        $requestOptions = $this->buildRequestOptions($request);

        return $request->send($request->getHttpMethod()->value, $request->getEndpoint(), $requestOptions);
    }

    /**
     * Build & Get HTTP factory.
     */
    public function buildHttpFactory(): HttpFactory
    {
        return $this->httpFactory = $this->httpFactory ?? new HttpFactory;
    }

    /**
     * Build base HTTP request.
     */
    protected function buildBaseRequest(HttpFactory $factory): PendingRequest
    {
        /** @var PendingRequest $request */
        $request = $factory->baseUrl($this->getBaseUrl())
            ->asJson()
            ->connectTimeout($this->connectTimeout)
            ->timeout($this->timeout);

        return $request;
    }

    /**
     * Apply auth credentials to request.
     */
    protected function applyAuthCredentials(PendingRequest $request): void
    {
        $this->auth->applyCredentials($request);
    }

    /**
     * Applies HTTP middleware to request.
     */
    protected function applyHttpMiddleware(PendingRequest $request): void
    {
        foreach ($this->middlewares as $middleware) {
            $request->withMiddleware($middleware);
        }
    }

    /**
     * Apply endpoint defaults to request.
     */
    protected function applyEndpointDefaults(PendingRequest $request, EndpointContract $endpoint): void
    {
        $request
            ->useMethod($endpoint->useHttpMethod())
            ->setEndpoint($endpoint->endpointUrl());
    }

    /**
     * Build HTTP request options.
     *
     * @return array<string, mixed>
     */
    protected function buildRequestOptions(PendingRequest $request): array
    {
        $requestOptions = [];

        if ($query = $request->getCompiledQuery()) {
            $requestOptions['query'] = $query;
        }

        if ($request->getHttpMethod() != HttpMethodEnum::GET) {
            if ($requestData = $request->getData()) {
                $requestOptions[$request->getBodyFormat()] = $requestData;
            }
        }

        return $requestOptions;
    }

    /**
     * Base URL.
     */
    protected function getBaseUrl(): string
    {
        return 'https://api.cloudycdn.services/api/v5';
    }
}
