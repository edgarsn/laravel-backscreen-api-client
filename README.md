# Laravel TET Media Services API Client

This package helps you to make API calls to TET Media Services API v5.

https://api.cloudycdn.services/api/v5/docs

## Requirements
- Laravel 9.0+, 10.0+, 11.0+
- PHP 8.1+

## Installation
Require the package via Composer:

```bash
composer require newman/laravel-tms-api-client
```

Copy config file to your `config` directory.
```bash
php artisan vendor:publish --tag=tms-api-config
```

Add environment variables to your `.env` file.

```dotenv
TMS_DEFAULT_USERNAME="API Key"
TMS_DEFAULT_PASSWORD="API Secret"
```

At last, you can add extra client to your `tms-api.php` config file with other credentials or different default settings.

# :book: Documentation & Usage

## Clients

### Access client from config

```php
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

TmsApi::client('default')->run(...);
```

### Create a client dynamically

We recommend to do this on your `AppServiceProvider`, inside `boot` function.

```php
use Newman\LaravelTmsApiClient\Auth\BasicAuthMethod;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$client = TmsApi::createClient('live', new BasicAuthMethod('api key', 'api secret'));

// and from now on you can access using client() as well
// TmsApi::client('live')->run(...);
```

### Authenticate via Bearer token

There are some endpoints (e.g. `/User/Login`) which doesn't require any authentication at all.

```php
use Newman\LaravelTmsApiClient\Auth\BearerAuthMethod;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

// 1) Retrieve Bearer token without any authentication.
$response = TmsApi::nullClient()->run(new Login('my@email.com', 'mypassword'));

$bearerToken = $response->json('data.auth_token');

// ... you may want to cache this token for some time

// 2) Override default client dynamically with other auth method.
TmsApi::createClient('default', new BearerAuthMethod($bearerToken));

// 3) now all calls on default client will use Bearer token as auth method.
// TmsApi::client('default')->run(...);
```

### Configure Client

**Note:** This will override settings for upcoming requests on `default` client.

#### `timeout` and `connectTimeout`

```php
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

TmsApi::client('default')->timeout(30)->connectTimeout(45);
```

#### `withMiddleware`

Append HTTP middleware to this client upcoming requests.

https://laravel.com/docs/9.x/http-client#guzzle-middleware

```php
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

TmsApi::client('default')->withMiddleware(...);
```

## Response

Response of the request is `\Illuminate\Http\Client\Reponse` object.

# Endpoints

We created this package with only few implementations of TMS endpoints. PRs are welcome to add more.

For each endpoint argument (except required ones) you'll find a correspoding setter function.

Here is the list of implemented endpoints:

## `/Token`

### Endpoint: `/Token/Generate`

https://api.cloudycdn.services/api/v5/docs#/operations/Token/Generate

Generates a new token.

**Accepted Auth Methods:** `Basic`, `Bearer token`, `API Key`

```php
use Newman\LaravelTmsApiClient\Endpoints\Token\Generate as TokenGenerate;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$endpoint = new TokenGenerate(123456, TokenGenerate\ItemTypeEnum::MEDIA);

// Optional
$endpoint->allowedCountries(['lv', 'lt', 'ee']);
$endpoint->allowedIp('85.110.62.99');

$endpoint->expireTime(1674074046);
$endpoint->expireTime('2023-01-18 12:34:56');
$endpoint->expireTime(\Carbon\Carbon::now()->addHour());

$endpoint->subitemId(5);
$endpoint->subitemType(TokenGenerate\SubitemTypeEnum::PLAYBACK_HLS);

$response = TmsApi::client('default')->run($endpoint);
```

## `/Media`

### Endpoint: `/Media/List`

https://api.cloudycdn.services/api/v5/docs#/operations/Media/List

Retrieve a list of media.

**Accepted Auth Methods:** `Basic`, `Bearer token`, `API Key`

```php
use Newman\LaravelTmsApiClient\Endpoints\Media\MediaList;
use Newman\LaravelTmsApiClient\EndpointSupport\Enums\OrderDirectionEnum;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$endpoint = new MediaList();

// Optional
$endpoint->ids([123]); // media IDs
$endpoint->assetIds(['asset_id']);
$endpoint->categoryIds([5]);
$endpoint->onlyAvailable(true);
$endpoint->published(true);
$endpoint->search('lorem ipsum');
$endpoint->tags(['archive']);
$endpoint->return(['embed_player_codes', 'sources']);
$endpoint->imagesFallback(false);

$endpoint->publisherStatus(MediaList\PublisherStatusEnum::PUBLISHED);

$endpoint->status(MediaList\StatusEnum::INGESTED);
$endpoint->status([MediaList\StatusEnum::INGESTED, MediaList\StatusEnum::PLAYABLE]);

$endpoint->createdFrom(1674074046);
$endpoint->createdFrom('2023-01-18 12:34:56');
$endpoint->createdFrom(\Carbon\Carbon::now()->addHour());

$endpoint->createdTo(1674074046);
$endpoint->createdTo('2023-01-18 12:34:56');
$endpoint->createdTo(\Carbon\Carbon::now()->addHour());

$endpoint->updatedFrom(1674074046);
$endpoint->updatedFrom('2023-01-18 12:34:56');
$endpoint->updatedFrom(\Carbon\Carbon::now()->addHour());

$endpoint->updatedTo(1674074046);
$endpoint->updatedTo('2023-01-18 12:34:56');
$endpoint->updatedTo(\Carbon\Carbon::now()->addHour());

$endpoint->limit(5);
$endpoint->offset(10);

$endpoint->orderBy(MediaList\OrderByEnum::CREATED_AT);
$endpoint->orderDir(OrderDirectionEnum::ASC);

$response = TmsApi::client('default')->run($endpoint);
```

### Endpoint: `/Media/Create`

https://api.cloudycdn.services/api/v5/docs#/operations/Media/Create

Create media.

**Accepted Auth Methods:** `Basic`, `Bearer token`

```php
use Newman\LaravelTmsApiClient\Endpoints\Media\Create as MediaCreate;
use Newman\LaravelTmsApiClient\EndpointSupport\Callback;
use Newman\LaravelTmsApiClient\EndpointSupport\Enums\CallbackHttpMethodEnum;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;
use Newman\LaravelTmsApiClient\Endpoints\Media\Create\Files;
use Newman\LaravelTmsApiClient\Endpoints\Media\Create\Tags;

$endpoint = new MediaCreate('123');

// Optional
$endpoint->catId(542);
$endpoint->name('Name of media');
$endpoint->description('Description of media');
$endpoint->pgRating('PG-13');
$endpoint->autoTranscode(1);
$endpoint->embedPlayerId(123);
$endpoint->embedAdId(234);
$endpoint->embedProtectionId(345);
$endpoint->metadata([
    'key' => 'value'
]);
$endpoint->timezone('Europe/Riga');

$files = new MediaCreate\Files();
$files->url('https://mysite.com');
$files->username('username');
$files->password('secret');
$files->bitrate(3000);
$files->lang('LV');
$endpoint->files($files);

$tags = new MediaCreate\Tags();
$tags->set(['tag1', 'tag2']);
$tags->add(['tag3']);

$endpoint->callback(new Callback('https://mysite.com', CallbackHttpMethodEnum::POST));

$response = TmsApi::client('default')->run($endpoint);
```

### Endpoint: `/Media/Update`

https://api.cloudycdn.services/api/v5/docs#/operations/Media/Update

Update media.

**Accepted Auth Methods:** `Basic`, `Bearer token`, `API Key`

```php
use Newman\LaravelTmsApiClient\Endpoints\Media\Update as MediaUpdate;
use Newman\LaravelTmsApiClient\EndpointSupport\Callback;
use Newman\LaravelTmsApiClient\EndpointSupport\Enums\CallbackHttpMethodEnum;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;
use Newman\LaravelTmsApiClient\Endpoints\Media\Update\ByMediaId;
use Newman\LaravelTmsApiClient\Endpoints\Media\Update\ByAssetId;

// Select by which identificator to update
// by media ID
$endpoint = new MediaUpdate(new ByMediaId(123));
// by asset ID
$endpoint = new MediaUpdate(new ByAssetId('99_asset_id'));

// Optional
$endpoint->name('Name of media');
$endpoint->description('Description of media');

$images = new MediaUpdate\Images();
$images->thumbnail('thumbnail base64');
$images->placeholder('placeholder base64');
$images->playbutton('playbutton base64');
$images->logo('logo base64');
$endpoint->images($images);

$endpoint->callback(new Callback('https://mysite.com', CallbackHttpMethodEnum::POST));

$response = TmsApi::client('default')->run($endpoint);
```

### Endpoint: `/Media/Delete`

https://api.cloudycdn.services/api/v5/docs#/operations/Media/Delete

Delete media by ID/s.

**Accepted Auth Methods:** `Basic`, `Bearer token`

```php
use Newman\LaravelTmsApiClient\Endpoints\Media\Delete as MediaDelete;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

// Multiple IDs.
$endpoint = new MediaDelete([1234, 5678]);

$response = TmsApi::client('default')->run($endpoint);

// Single ID.
$endpoint = new MediaDelete(1234);

$response = TmsApi::client('default')->run($endpoint);
```

### Endpoint: `/Media/Clone`

https://api.cloudycdn.services/api/v5/docs#/operations/Media/Clone

Clone media by ID.

**Accepted Auth Methods:** `Basic`, `Bearer token`

```php
use Newman\LaravelTmsApiClient\Endpoints\Media\CloneMedia;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$endpoint = new CloneMedia(1234, 'asset_id_for_the_new_asset');

// Optional
$endpoint->name('Name for the new asset');

$response = TmsApi::client('default')->run($endpoint);
```

### Endpoint: `/Media/Trim`

https://api.cloudycdn.services/api/v5/docs#/operations/Media/Trim

**Accepted Auth Methods:** `Bearer token`

```php
use Newman\LaravelTmsApiClient\Endpoints\Media\Trim;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$endpoint = new Trim(1234, '00:00:10', '00:59:59', Trim\TypeEnum::NEW);

// Optional
$endpoint->name('Name');

$response = TmsApi::client('default')->run($endpoint);
```

### Endpoint: `/Media/Generateimage`

https://api.cloudycdn.services/api/v5/docs#/operations/Media/Generateimage

**Accepted Auth Methods:** `Basic`, `Bearer token`

```php
use Newman\LaravelTmsApiClient\Endpoints\Media\GenerateImage;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$endpoint = new GenerateImage(1234);

// Optional
$endpoint->mediaFileId(1902);
$endpoint->thumbnail('01:20:39');
$endpoint->placeholder('00:05:30');

$response = TmsApi::client('default')->run($endpoint);
```

### Endpoint: `/Media/Reset`

https://api.cloudycdn.services/api/v5/docs#/operations/Media/Reset

**Accepted Auth Methods:** `Bearer token`

```php
use Newman\LaravelTmsApiClient\Endpoints\Media\Reset;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$response = TmsApi::client('default')->run(new Reset(1234));
```

### Endpoint: `/Media/Transcode`

https://api.cloudycdn.services/api/v5/docs#/operations/Media/Transcode

**Accepted Auth Methods:** `Bearer token`

```php
use Newman\LaravelTmsApiClient\Endpoints\Media\Transcode;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$response = TmsApi::client('default')->run(new Transcode(1234));
```

### Endpoint: `/Media/Canceltranscode`

https://api.cloudycdn.services/api/v5/docs#/operations/Media/Canceltranscode

**Accepted Auth Methods:** `Bearer token`

```php
use Newman\LaravelTmsApiClient\Endpoints\Media\CancelTranscode;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$response = TmsApi::client('default')->run(new CancelTranscode(1234));
```

### Endpoint: `/Media/Updatesubtitlesfromsource`

https://api.cloudycdn.services/api/v5/docs#/operations/Media/Updatesubtitlesfromsource

**Accepted Auth Methods:** `Bearer token`

```php
use Newman\LaravelTmsApiClient\Endpoints\Media\UpdateSubtitlesFromSource;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$response = TmsApi::client('default')->run(new UpdateSubtitlesFromSource(1234));
```

### Endpoint: `/Media/Regeneratepackages`

https://api.cloudycdn.services/api/v5/docs#/operations/Media/Regeneratepackages

**Accepted Auth Methods:** `Bearer token`

```php
use Newman\LaravelTmsApiClient\Endpoints\Media\RegeneratePackages;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$endpoint = new RegeneratePackages(1234);

// Optional
$endpoint->packageId([10, 15]);

$response = TmsApi::client('default')->run($endpoint);
```

## `/Media/Manifest`

### Endpoint: `/Media/Manifest/List`

https://api.cloudycdn.services/api/v5/docs#/operations/Media/Manifest/List

Retrieve list of manifests.

**Accepted Auth Methods:** `Basic`, `Bearer token`, `API Key`

```php
use Newman\LaravelTmsApiClient\Endpoints\Media\Manifest\List\OrderByEnum;
use Newman\LaravelTmsApiClient\Endpoints\Media\Manifest\ManifestList;
use Newman\LaravelTmsApiClient\EndpointSupport\Enums\OrderDirectionEnum;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$endpoint = new ManifestList();

// Optional
$endpoint->ids([1, 2]); // manifest IDs
$endpoint->limit(10);
$endpoint->mediaIds([1234]);
$endpoint->offset(10);
$endpoint->orderBy(OrderByEnum::NAME);
$endpoint->orderDir(OrderDirectionEnum::DESC);

$response = TmsApi::client('default')->run($endpoint);
```

### Endpoint: `/Media/Manifest/Create`

https://api.cloudycdn.services/api/v5/docs#/operations/Media/Manifest/Create

Create a new media manifest.

**Accepted Auth Methods:** `Basic`, `Bearer token`

```php
use Newman\LaravelTmsApiClient\Endpoints\Media\Manifest\Create as MediaManifestCreate;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$endpoint = new MediaManifestCreate(1234); // media ID

// Optional
$endpoint->name('Name of the manifest');
$endpoint->default(true);
$endpoint->startAt(1000);
$endpoint->endAt(60000);
$endpoint->files([582, 583]);
$endpoint->packageId(4020);

$response = TmsApi::client('default')->run($endpoint);
```

### Endpoint: `/Media/Manifest/Update`

https://api.cloudycdn.services/api/v5/docs#/operations/Media/Manifest/Update

Update media manifest by manifest ID.

**Accepted Auth Methods:** `Basic`, `Bearer token`

```php
use Newman\LaravelTmsApiClient\Endpoints\Media\Manifest\Update as MediaManifestUpdate;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$endpoint = new MediaManifestUpdate(85291); // manifest ID

// Same optional functions as "/Media/Manifest/Create" endpoint.

$response = TmsApi::client('default')->run($endpoint);
```

### Endpoint: `/Media/Manifest/Delete`

https://api.cloudycdn.services/api/v5/docs#/operations/Media/Manifest/Delete

Delete media manifest by manifest ID.

**Accepted Auth Methods:** `Basic`, `Bearer token`

```php
use Newman\LaravelTmsApiClient\Endpoints\Media\Manifest\Delete as MediaManifestDelete;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$response = TmsApi::client('default')->run(new MediaManifestDelete(85291)); // manifest ID
```

## `/User`

### Endpoint: `/User/Get`

https://api.cloudycdn.services/api/v5/docs#/operations/User/Get

Return current user info. Returns the same values as login action, but without auth_token.

**Accepted Auth Methods:** `Bearer token`

```php
use Newman\LaravelTmsApiClient\Endpoints\User\Get as UserGet;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$endpoint = new UserGet();

// Optional
$endpoint->return(['client.limits']);

$response = TmsApi::client('default')->run($endpoint);
```

### Endpoint: `/User/Login`

https://api.cloudycdn.services/api/v5/docs#/operations/User/Login

Login user by email & password to retrieve Bearer token.

**Accepted Auth Methods:** `Null`

```php
use Newman\LaravelTmsApiClient\Endpoints\User\Login as UserLogin;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$endpoint = new UserLogin('my@email.com', 'password');

// Optional
$endpoint->twoFaCode('123456');
$endpoint->return(['client.limits']);

$response = TmsApi::nullClient()->run($endpoint);
```

### Endpoint: `/User/Logout`

https://api.cloudycdn.services/api/v5/docs#/operations/User/Logout

Logout currently authenticated user.

**Accepted Auth Methods:** `Bearer token`

```php
use Newman\LaravelTmsApiClient\Endpoints\User\Logout as UserLogout;
use Newman\LaravelTmsApiClient\Support\Facades\TmsApi;

$response = TmsApi::client('default')->run(new UserLogout());
```

# :handshake: Contributing

We'll appreciate your collaboration to this package.

When making pull requests, make sure:
* All tests are passing: `composer test`
* Test coverage is not reduced: `composer test-coverage`
* There are no PHPStan errors: `composer phpstan`
* Coding standard is followed: `composer lint` or `composer fix-style` to automatically fix it. 
