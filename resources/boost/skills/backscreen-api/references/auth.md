# Auth Reference

All auth classes live in `src/Auth/` and implement `AuthMethodContract`.
Auth method is set per-client, not per-request.

## Auth Methods

### `BasicAuthMethod` — `src/Auth/BasicAuthMethod.php`
- Default when using `TmsApi::client($name)` — reads `backscreen-api.clients.{name}.auth.username` / `.password`
- Sends credentials as HTTP Basic Auth header
- Enum value: `AuthMethodEnum::BASIC`

### `BearerAuthMethod` — `src/Auth/BearerAuthMethod.php`
- Use after `User/Login` returns a token
- `new BearerAuthMethod($token)`
- Sends `Authorization: Bearer {token}` header
- Enum value: `AuthMethodEnum::BEARER`

### `ApiKeyAuthMethod` — `src/Auth/ApiKeyAuthMethod.php`
- Alternative API key flow
- `new ApiKeyAuthMethod($apiKey)`
- Sends key as query param
- Enum value: `AuthMethodEnum::API_KEY`

### `NullAuthMethod` — `src/Auth/NullAuthMethod.php`
- No credentials sent — required for unauthenticated endpoints (e.g. `User/Login`)
- Enum value: `AuthMethodEnum::NULL`

## Getting a Client

**Config-based (BasicAuth):**
```php
// Reads backscreen-api.clients.default.auth.{username,password}
$client = TmsApi::client('default');
```

**Dynamic client (e.g. after login):**
```php
$response = TmsApi::nullClient()->run(new User\Login($username, $password));
$token = $response->json('token');

$client = TmsApi::createClient('user-session', new BearerAuthMethod($token));
$client->run(new User\Get);
```

**Null client (pre-configured):**
```php
TmsApi::nullClient()->run(new User\Login($u, $p));
```

## Auth in Endpoints

Each endpoint declares which auth methods it accepts:
```php
public function allowedAuthMethods(): array
{
    return [AuthMethodEnum::BASIC, AuthMethodEnum::BEARER];
}
```

`AbstractEndpoint` defaults to `[BASIC, BEARER, API_KEY]`.
`User/Login` overrides to `[NULL]` only.
`User/Logout` and `User/Get` override to `[BEARER]` only.

Calling an endpoint with an unsupported auth method throws `TmsAuthMethodNotAllowed`.

## Config Structure (`config/backscreen-api.php`)

```php
'clients' => [
    'default' => [
        'auth' => [
            'username' => env('BACKSCREEN_USERNAME'),
            'password' => env('BACKSCREEN_PASSWORD'),
        ],
        'http' => [
            'timeout' => 15,         // optional
            'connect_timeout' => 15, // optional
        ],
    ],
],
```
