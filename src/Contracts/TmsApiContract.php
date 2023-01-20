<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Contracts;

interface TmsApiContract
{
    /**
     * Get instance of a client.
     *
     * @param string $name
     * @return ClientContract
     */
    public function client(string $name): ClientContract;

    /**
     * Get client for authentication by user login to retrieve Bearer token.
     *
     * @return ClientContract
     */
    public function nullClient(): ClientContract;

    /**
     * Create a new client dynamically.
     *
     * @param string $name
     * @param AuthMethodContract $auth
     * @return ClientContract
     */
    public function createClient(string $name, AuthMethodContract $auth): ClientContract;

    /**
     * Get list of clients.
     *
     * @return array<string, ClientContract>
     */
    public function getClients(): array;
}
