<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Contracts;

use Illuminate\Http\Client\Response;
use Newman\LaravelTmsApiClient\HttpClient\HttpFactory;

interface ClientContract
{
    public function __construct(AuthMethodContract $auth);

    /**
     * Customize HTTP timeout for client.
     *
     * @param int $seconds
     * @return $this
     */
    public function timeout(int $seconds): static;

    /**
     * Customize HTTP connect timeout for client.
     *
     * @param int $seconds
     * @return $this
     */
    public function connectTimeout(int $seconds): static;

    /**
     * Append HTTP Client middleware.
     *
     * @param callable $middleware
     * @return $this
     */
    public function withMiddleware(callable $middleware): static;

    /**
     * Run Endpoint.
     *
     * @param EndpointContract $endpoint
     * @return Response
     * @throws \Exception
     */
    public function run(EndpointContract $endpoint): Response;

    /**
     * Build & Get HTTP factory.
     *
     * @return HttpFactory
     */
    public function buildHttpFactory(): HttpFactory;
}
