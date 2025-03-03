<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Contracts;

interface TmsApiContract
{
    /**
     * Get instance of a client.
     */
    public function client(string $name): ClientContract;

    /**
     * Get client for authentication by user login to retrieve Bearer token.
     */
    public function nullClient(): ClientContract;

    /**
     * Create a new client dynamically.
     */
    public function createClient(string $name, AuthMethodContract $auth): ClientContract;

    /**
     * Get list of clients.
     *
     * @return array<string, ClientContract>
     */
    public function getClients(): array;
}
