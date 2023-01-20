<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Unit;

use GuzzleHttp\Middleware;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Arr;
use Newman\LaravelTmsApiClient\Auth\BasicAuthMethod;
use Newman\LaravelTmsApiClient\Auth\BearerAuthMethod;
use Newman\LaravelTmsApiClient\Client;
use Newman\LaravelTmsApiClient\Exceptions\TmsAuthMethodNotAllowed;
use Newman\LaravelTmsApiClient\Tests\Support\GetTestEndpoint;
use Newman\LaravelTmsApiClient\Tests\Support\PostTestBearerOnlyEndpoint;
use Newman\LaravelTmsApiClient\Tests\TestCase;
use Psr\Http\Message\RequestInterface;

class ClientTest extends TestCase
{
    public function test_with_simple_get(): void
    {
        $client = new Client(new BasicAuthMethod('user', 'pass'));

        $factory = $client->buildHttpFactory();
        $factory->preventStrayRequests();
        $factory->fake([
            'api.cloudycdn.services/api/v5/Test?status=ingested' => $factory->response(['msg' => '', 'code' => 0])
        ]);

        $response = $client
            ->timeout(10)
            ->connectTimeout(20)
            ->run(new GetTestEndpoint());

        $this->assertTrue($response->successful());
        $this->assertEquals(['msg' => '', 'code' => 0], $response->json());
    }

    public function test_it_throws_exception_when_calling_endpoint_with_not_allowed_auth_method(): void
    {
        $client = new Client(new BasicAuthMethod('user', 'pass'));

        $factory = $client->buildHttpFactory();
        $factory->preventStrayRequests();
        $factory->fake([
            'api.cloudycdn.services/api/v5/Test/Create' => $factory->response(['msg' => 'Created', 'code' => 0])
        ]);

        $this->expectException(TmsAuthMethodNotAllowed::class);

        $client->run(new PostTestBearerOnlyEndpoint());
    }

    public function test_it_posts_data(): void
    {
        $client = new Client(new BearerAuthMethod('abc'));

        $factory = $client->buildHttpFactory();
        $factory->preventStrayRequests();
        $factory->fake(function (Request $request) use ($factory) {
            if ($request->url() != 'https://api.cloudycdn.services/api/v5/Test/Create') {
                return $factory->response('Not Found', 404);
            }

            if (isset($request->data()['status'])) {
                return $factory->response(['msg' => 'Created', 'code' => 0]);
            } else {
                return $factory->response('Not Found', 404);
            }
        });

        $response = $client->run(new PostTestBearerOnlyEndpoint());

        $this->assertTrue($response->successful());
        $this->assertEquals(['msg' => 'Created', 'code' => 0], $response->json());
    }

    public function test_apply_middleware(): void
    {
        $client = new Client(new BasicAuthMethod('user', 'pass'));

        $factory = $client->buildHttpFactory();
        $factory->preventStrayRequests();
        $factory->fake([
            'api.cloudycdn.services/api/v5/Test?status=ingested' => $factory->response(['msg' => '', 'code' => 0])
        ]);

        $response = $client
            ->withMiddleware(
                Middleware::mapRequest(function (RequestInterface $request) {
                    $request = $request->withHeader('X-Example', 'Value');

                    return $request;
                })
            )
            ->run(new GetTestEndpoint());

        $this->assertEquals('Value', Arr::get($response->transferStats->getRequest()->getHeader('X-Example'), 0));
    }
}
