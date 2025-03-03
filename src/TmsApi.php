<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Newman\LaravelBackscreenApiClient\Auth\BasicAuthMethod;
use Newman\LaravelBackscreenApiClient\Auth\NullAuthMethod;
use Newman\LaravelBackscreenApiClient\Contracts\AuthMethodContract;
use Newman\LaravelBackscreenApiClient\Contracts\ClientContract;
use Newman\LaravelBackscreenApiClient\Contracts\TmsApiContract;
use Newman\LaravelBackscreenApiClient\Exceptions\InvalidTmsApiClientException;

class TmsApi implements TmsApiContract
{
    /**
     * @var array<string, ClientContract>
     */
    protected array $clients = [];

    public function __construct(protected Application $app) {}

    /**
     * Get instance of a client.
     */
    public function client(string $name): ClientContract
    {
        $clientConfig = Config::get('tms-api.clients.'.$name);

        if (! Config::has('tms-api.clients.'.$name) || ! is_array($clientConfig)) {
            throw new InvalidTmsApiClientException('TMS Api client could\'nt be found.');
        }

        if (! isset($this->clients[$name])) {
            if (! Arr::has($clientConfig, 'auth.username') || ! Arr::has($clientConfig, 'auth.password')) {
                throw new InvalidTmsApiClientException('TMS Api client auth credentials are not provided.');
            }

            $clientUsername = Config::string('tms-api.clients.'.$name.'.auth.username');
            $clientPassword = Config::string('tms-api.clients.'.$name.'.auth.password');

            $basicAuth = new BasicAuthMethod($clientUsername, $clientPassword);

            $this->clients[$name] = $this->makeClient($basicAuth);
        }

        $pendingClient = clone $this->clients[$name];

        if (Arr::has($clientConfig, 'http')) {
            if (Arr::has($clientConfig, 'http.timeout')) {
                $this->clients[$name]->timeout(Config::integer('tms-api.clients.'.$name.'.http.timeout'));
            }

            if (Arr::has($clientConfig, 'http.connect_timeout')) {
                $this->clients[$name]->connectTimeout(Config::integer('tms-api.clients.'.$name.'.http.connect_timeout'));
            }
        }

        return $pendingClient;
    }

    /**
     * Get client for authentication by user login to retrieve Bearer token.
     */
    public function nullClient(): ClientContract
    {
        if (isset($this->clients['null'])) {
            return $this->clients['null'];
        } else {
            return $this->createClient('null', new NullAuthMethod);
        }
    }

    /**
     * Create a new client dynamically.
     */
    public function createClient(string $name, AuthMethodContract $auth): ClientContract
    {
        $this->clients[$name] = $this->makeClient($auth);

        return $this->clients[$name];
    }

    /**
     * Get list of clients.
     *
     * @return array<string, ClientContract>
     */
    public function getClients(): array
    {
        return $this->clients;
    }

    protected function makeClient(AuthMethodContract $auth): ClientContract
    {
        /** @var ClientContract $client */
        $client = $this->app->makeWith(ClientContract::class, ['auth' => $auth]);

        return $client;
    }
}
