---
name: backscreen-api
description: >
  Laravel TMS API client for Backscreen API v5. Use when building or modifying
  API endpoints (Media, Live, Folder, Token, User, Manifest), configuring auth,
  running the client, or writing tests with the fake client.
compatibility: Laravel 11+, PHP 8.2+
---

# Backscreen API Client

Package namespace: `Newman\LaravelBackscreenApiClient`
Base URL: `https://api.cloudycdn.services/api/v5`

## Running an Endpoint

```php
use Newman\LaravelBackscreenApiClient\Support\Facades\TmsApi;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create;

$response = TmsApi::client('default')->run(new Create('asset-id-123'));
```

`TmsApi::client($name)` resolves config from `backscreen-api.clients.{name}` and uses BasicAuth by default.
`client->run(EndpointContract)` returns `Illuminate\Http\Client\Response`.

## Fluent Builder Pattern

Endpoints accept optional parameters via fluent setters. Sub-objects (Security, Embed, Availability, etc.) are passed as dedicated classes:

```php
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Security;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Availability;

$endpoint = (new Create('asset-id'))
    ->name('My Video')
    ->security((new Security)->tokenDuration(...))
    ->availability((new Availability)->from(now()));

$response = TmsApi::client('default')->run($endpoint);
```

## Adding a New Endpoint

1. Extend `AbstractEndpoint`, implement `EndpointContract`
2. Declare optional params as `protected ?Type $prop = null`
3. Add fluent setters returning `static`
4. Implement `useHttpMethod()`, `endpointUrl()`, `prepareHttpRequest(PendingRequest $http)`
5. Override `allowedAuthMethods()` if endpoint restricts auth (default: BASIC, BEARER, API_KEY)
6. In `prepareHttpRequest`: build `$data` array, call `$http->withData($data)` (POST/PUT) or `$http->withQuery($query)` (GET)

Sub-object classes use `CompilesProperties` trait — all `protected` properties auto-serialize via `compileAsArray()`. Null properties are excluded automatically.

For endpoint reference and per-group details see [references/endpoints.md](references/endpoints.md).

## Auth Methods

| Method | Class | Use case |
|--------|-------|----------|
| Basic | `BasicAuthMethod` | Default — `TmsApi::client()` config-driven |
| Bearer | `BearerAuthMethod` | After `User/Login` returns token |
| ApiKey | `ApiKeyAuthMethod` | API key flow |
| Null | `NullAuthMethod` | Unauthenticated (e.g. `User/Login` itself) |

For dynamic clients: `TmsApi::createClient('name', new BearerAuthMethod($token))`
For null client: `TmsApi::nullClient()`

Full details in [references/auth.md](references/auth.md).

## Gotchas

- `Client::run()` throws `TmsAuthMethodNotAllowed` if the client's auth method isn't in `allowedAuthMethods()`
- `CompilesProperties` reflects only `protected` properties — `private` properties are invisible to it
- Booleans compile as `1`/`0` (not `true`/`false`), enums compile to their `->value`, Carbon instances to `toDateTimeString()`
- `embedPlayerId`, `embedAdId`, `embedProtectionId`: `-1` = inherit, `0` = none, `>0` = specific ID
- Sub-object data is only included if `compileAsArray()` returns a non-empty array — pass `null` to omit

## Testing

Use `HttpFactory::fake()` on the client's factory instance. See [references/testing.md](references/testing.md).

