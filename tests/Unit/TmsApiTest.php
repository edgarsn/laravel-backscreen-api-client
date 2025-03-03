<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Unit;

use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Newman\LaravelBackscreenApiClient\Auth\ApiKeyAuthMethod;
use Newman\LaravelBackscreenApiClient\Client;
use Newman\LaravelBackscreenApiClient\Contracts\ClientContract;
use Newman\LaravelBackscreenApiClient\Exceptions\InvalidTmsApiClientException;
use Newman\LaravelBackscreenApiClient\Support\Facades\TmsApi;
use Newman\LaravelBackscreenApiClient\Tests\Support\GetTestEndpoint;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class TmsApiTest extends TestCase
{
    public function test_it_creates_null_client_and_stores(): void
    {
        TmsApi::fake();

        $this->assertEquals([], TmsApi::getClients());

        TmsApi::nullClient();

        $this->assertInstanceOf(Client::class, Arr::get(TmsApi::getClients(), 'null'));

        $client = TmsApi::nullClient();

        $this->assertInstanceOf(Client::class, $client);
    }

    public function test_it_can_create_a_client(): void
    {
        TmsApi::fake();

        $this->assertEquals([], TmsApi::getClients());

        TmsApi::createClient('lorem', new ApiKeyAuthMethod('loremApiKey'));

        $this->assertInstanceOf(Client::class, Arr::get(TmsApi::getClients(), 'lorem'));
    }

    public function test_it_can_build_client_from_config_and_store(): void
    {
        TmsApi::fake();

        $this->assertEquals([], TmsApi::getClients());

        /** @var ConfigRepository $config */
        $config = $this->app->make(ConfigRepository::class);

        $config->set('tms-api.clients', [
            'ipsum' => [
                'auth' => [
                    'username' => 'lorem',
                    'password' => 'ipsum',
                ],

                'http' => [
                    'timeout' => 10,
                    'connect_timeout' => 20,
                ],
            ],
        ]);

        TmsApi::client('ipsum');

        $this->assertInstanceOf(Client::class, Arr::get(TmsApi::getClients(), 'ipsum'));
    }

    public function test_it_throws_exception_when_api_client_couldnt_be_found_in_config(): void
    {
        TmsApi::fake();

        $this->assertEquals([], TmsApi::getClients());

        /** @var ConfigRepository $config */
        $config = $this->app->make(ConfigRepository::class);

        $config->set('tms-api.clients', []);

        $this->expectException(InvalidTmsApiClientException::class);
        $this->expectExceptionMessage('TMS Api client could\'nt be found.');

        TmsApi::client('lorem');
    }

    public function test_it_throws_exception_when_api_client_auth_config_is_not_provided(): void
    {
        TmsApi::fake();

        $this->assertEquals([], TmsApi::getClients());

        /** @var ConfigRepository $config */
        $config = $this->app->make(ConfigRepository::class);

        $config->set('tms-api.clients', [
            'ipsum' => [
                'auth' => [
                ],

                'http' => [
                    'timeout' => 10,
                    'connect_timeout' => 20,
                ],
            ],
        ]);

        $this->expectException(InvalidTmsApiClientException::class);
        $this->expectExceptionMessage('TMS Api client auth credentials are not provided.');

        TmsApi::client('ipsum');
    }

    public function test_it_respects_individual_timeouts_on_client(): void
    {
        TmsApi::fake();

        /** @var ConfigRepository $config */
        $config = $this->app->make(ConfigRepository::class);

        $config->set('tms-api.clients', [
            'ipsum' => [
                'auth' => [
                    'username' => 'lorem',
                    'password' => 'ipsum',
                ],

                'http' => [
                    'timeout' => 1,
                    'connect_timeout' => 1,
                ],
            ],
        ]);

        $runClientTest = function (ClientContract $client, int $timeout, int $connection_timeout) {
            $actualClientTimeout = null;
            $actualClientConnectionTimeout = null;

            $clientHttpFactory = $client->buildHttpFactory();
            $clientHttpFactory->preventStrayRequests();
            $clientHttpFactory->fake(function (Request $request, array $options) use (&$actualClientTimeout, &$actualClientConnectionTimeout) {
                $actualClientTimeout = $options['timeout'];
                $actualClientConnectionTimeout = $options['connect_timeout'];

                if ($request->url() == 'https://api.cloudycdn.services/api/v5/Test?status=ingested') {
                    return Http::response(['msg' => '', 'code' => 0]);
                }

                return Http::response('----', 404);
            });

            $client
                ->timeout($timeout)
                ->connectTimeout($connection_timeout)
                ->run(new GetTestEndpoint);

            $this->assertEquals($timeout, $actualClientTimeout);
            $this->assertEquals($connection_timeout, $actualClientConnectionTimeout);
        };

        $runClientTest(TmsApi::client('ipsum'), 15, 15);
        $runClientTest(TmsApi::client('ipsum'), 20, 20);
    }
}
