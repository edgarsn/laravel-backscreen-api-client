<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Unit\Auth;

use Illuminate\Support\Arr;
use Newman\LaravelBackscreenApiClient\Auth\BasicAuthMethod;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\HttpFactory;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class BasicAuthMethodTest extends TestCase
{
    public function test(): void
    {
        $auth = new BasicAuthMethod('lorem', 'ipsum');

        $factory = new HttpFactory;
        /** @var PendingRequest $request */
        $request = $factory->baseUrl('https://api.localhost');

        $auth->applyCredentials($request);

        $this->assertEquals(AuthMethodEnum::BASIC, $auth->getAuthMethod());
        $this->assertEquals(['lorem', 'ipsum'], Arr::get($request->getOptions(), 'auth'));
    }
}
