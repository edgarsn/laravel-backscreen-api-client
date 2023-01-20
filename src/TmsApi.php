<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Newman\LaravelTmsApiClient\Auth\BasicAuthMethod;
use Newman\LaravelTmsApiClient\Auth\NullAuthMethod;
use Newman\LaravelTmsApiClient\Contracts\AuthMethodContract;
use Newman\LaravelTmsApiClient\Contracts\ClientContract;
use Newman\LaravelTmsApiClient\Contracts\TmsApiContract;
use Newman\LaravelTmsApiClient\Exceptions\InvalidTmsApiClientException;

class TmsApi implements TmsApiContract
{
    /**
     * @var array<string, ClientContract>
     */
    protected array $clients = [];

    public function __construct(protected Application $app)
    {
    }

    /**
     * Get instance of a client.
     *
     * @param string $name
     * @return ClientContract
     */
    public function client(string $name): ClientContract
    {
        if (!isset($this->clients[$name])) {
            $clientConfig = Config::get('tms-api.clients.' . $name);

            if (!Config::has('tms-api.clients.' . $name) || !is_array($clientConfig)) {
                throw new InvalidTmsApiClientException('TMS Api client could\'nt be found.');
            }

            if (!Arr::has($clientConfig, 'auth.username') || !Arr::has($clientConfig, 'auth.password')) {
                throw new InvalidTmsApiClientException('TMS Api client auth credentials are not provided.');
            }

            $basicAuth = new BasicAuthMethod($clientConfig['auth']['username'], $clientConfig['auth']['password']);

            $this->clients[$name] = $this->makeClient($basicAuth);

            if (isset($clientConfig['http'])) {
                if (isset($clientConfig['http']['timeout'])) {
                    $this->clients[$name]->timeout((int)$clientConfig['http']['timeout']);
                }

                if (isset($clientConfig['http']['connect_timeout'])) {
                    $this->clients[$name]->connectTimeout((int)$clientConfig['http']['connect_timeout']);
                }
            }
        }

        return $this->clients[$name];
    }

    /**
     * Get client for authentication by user login to retrieve Bearer token.
     *
     * @return ClientContract
     */
    public function nullClient(): ClientContract
    {
        if (isset($this->clients['null'])) {
            return $this->clients['null'];
        } else {
            return $this->createClient('null', new NullAuthMethod());
        }
    }

    /**
     * Create a new client dynamically.
     *
     * @param string $name
     * @param AuthMethodContract $auth
     * @return ClientContract
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
