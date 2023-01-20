<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Unit\Auth;

use Newman\LaravelTmsApiClient\Auth\ApiKeyAuthMethod;
use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\HttpFactory;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;
use Newman\LaravelTmsApiClient\Tests\TestCase;

class ApiKeyAuthMethodTest extends TestCase
{
    public function test(): void
    {
        $auth = new ApiKeyAuthMethod('12345');

        $factory = new HttpFactory();
        /** @var PendingRequest $request */
        $request = $factory->baseUrl('https://api.localhost');

        $auth->applyCredentials($request);

        $this->assertEquals(AuthMethodEnum::API_KEY, $auth->getAuthMethod());
        $this->assertEquals(['paramauth' => '12345'], $request->getCompiledQuery());
    }
}
