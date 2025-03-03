<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Unit\Auth;

use Illuminate\Support\Arr;
use Newman\LaravelBackscreenApiClient\Auth\BearerAuthMethod;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\HttpFactory;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

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
