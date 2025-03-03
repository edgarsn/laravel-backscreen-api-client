<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Contracts;

use Illuminate\Http\Client\Response;
use Newman\LaravelBackscreenApiClient\HttpClient\HttpFactory;

interface ClientContract
{
    public function __construct(AuthMethodContract $auth);

    /**
     * Customize HTTP timeout for client.
     *
     * @return $this
     */
    public function timeout(int $seconds): static;

    /**
     * Customize HTTP connect timeout for client.
     *
     * @return $this
     */
    public function connectTimeout(int $seconds): static;

    /**
     * Append HTTP Client middleware.
     *
     * @return $this
     */
    public function withMiddleware(callable $middleware): static;

    /**
     * Run Endpoint.
     *
     * @throws \Exception
     */
    public function run(EndpointContract $endpoint): Response;

    /**
     * Build & Get HTTP factory.
     */
    public function buildHttpFactory(): HttpFactory;
}
