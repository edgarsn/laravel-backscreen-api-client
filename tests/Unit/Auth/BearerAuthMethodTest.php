<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Unit\Auth;

use Illuminate\Support\Arr;
use Newman\LaravelTmsApiClient\Auth\BearerAuthMethod;
use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\HttpFactory;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;
use Newman\LaravelTmsApiClient\Tests\TestCase;

class BearerAuthMethodTest extends TestCase
{
    public function test(): void
    {
        $auth = new BearerAuthMethod('lorem');

        $factory = new HttpFactory;
        /** @var PendingRequest $request */
        $request = $factory->baseUrl('https://api.localhost');

        $auth->applyCredentials($request);

        $this->assertEquals(AuthMethodEnum::BEARER, $auth->getAuthMethod());
        $this->assertEquals('Bearer lorem', Arr::get($request->getOptions(), 'headers.Authorization'));
    }
}
