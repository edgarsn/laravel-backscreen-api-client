# Testing Reference

## Test Pattern for Endpoints

All endpoint tests extend `Tests\Endpoints\TestCase` which provides helpers:

```php
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class MyEndpointTest extends TestCase
{
    public function test_basic(): void
    {
        $this->makeBasicAuthEndpointTest(
            new MyEndpoint('required-arg'),
            query: [],               // expected query params
            body: ['field' => 'val'], // expected request body (null to skip check)
            fakeResponse: ['code' => 0, 'msg' => 'ok'], // optional, defaults to ['msg' => '', 'code' => 0]
        );
    }
}
```

Available helpers:
- `makeBasicAuthEndpointTest` — BasicAuthMethod
- `makeBearerAuthEndpointTest` — BearerAuthMethod
- `makeApiKeyAuthEndpointTest` — ApiKeyAuthMethod
- `makeNullAuthEndpointTest` — NullAuthMethod
- `makeEndpointTestWithCilent` — arbitrary `ClientContract`

The helper fakes the URL `api.cloudycdn.services/api/v5{endpoint->endpointUrl()}`, runs the endpoint, and asserts the response body matches `$fakeResponse`.

## How `HttpFactory::fake()` Works

`HttpFactory` extends Laravel's HTTP `Factory`. Calling `fake()` on it resets `stubCallbacks` to a fresh `Collection` first (preventing callback bleed between tests).

```php
$factory = $client->buildHttpFactory();
$factory->preventStrayRequests();
$factory->fake([
    'api.cloudycdn.services/api/v5/Media/Create' => $factory->response(['code' => 0]),
]);

$response = $client->run($endpoint);
```

## Gotchas

- `HttpFactory` is static per `Client` class (`Client::$httpFactory`). Tests that call `buildHttpFactory()` get the same factory instance across tests unless reset.
- `fake()` on `HttpFactory` calls `$this->stubCallbacks = new Collection` before delegating to parent — this is the fix that prevents stub leakage between sequential tests.
- For auth-restriction tests: constructing `new Client(new BasicAuthMethod(...))` and running a Bearer-only endpoint throws `TmsAuthMethodNotAllowed`.
- Body assertion uses `(string) $response->transferStats->getRequest()->getBody()` — it's the raw JSON string. Arrays are `json_encode`d for comparison.

## TmsApiFake

`TmsApiFake` is a thin proxy that forwards all method calls to a real `TmsApiContract` instance. It exists for swapping the facade binding in feature tests:

```php
// In a service provider or test setup:
$this->app->bind(TmsApiContract::class, function ($app) {
    return new TmsApiFake($app->make(TmsApi::class));
});
```

For endpoint-level tests, prefer the `TestCase` helpers above — they operate at the `Client` level, not the facade level.
