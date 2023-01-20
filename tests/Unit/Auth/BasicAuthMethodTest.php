<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Unit\Auth;

use Illuminate\Support\Arr;
use Newman\LaravelTmsApiClient\Auth\BasicAuthMethod;
use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\HttpFactory;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;
use Newman\LaravelTmsApiClient\Tests\TestCase;

class BasicAuthMethodTest extends TestCase
{
    public function test(): void
    {
        $auth = new BasicAuthMethod('lorem', 'ipsum');

        $factory = new HttpFactory();
        /** @var PendingRequest $request */
        $request = $factory->baseUrl('https://api.localhost');

        $auth->applyCredentials($request);

        $this->assertEquals(AuthMethodEnum::BASIC, $auth->getAuthMethod());
        $this->assertEquals(['lorem', 'ipsum'], Arr::get($request->getOptions(), 'auth'));
    }
}
