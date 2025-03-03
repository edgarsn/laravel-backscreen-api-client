<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Unit\Auth;

use Newman\LaravelBackscreenApiClient\Auth\ApiKeyAuthMethod;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\HttpFactory;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class ApiKeyAuthMethodTest extends TestCase
{
    public function test(): void
    {
        $auth = new ApiKeyAuthMethod('12345');

        $factory = new HttpFactory;
        /** @var PendingRequest $request */
        $request = $factory->baseUrl('https://api.localhost');

        $auth->applyCredentials($request);

        $this->assertEquals(AuthMethodEnum::API_KEY, $auth->getAuthMethod());
        $this->assertEquals(['paramauth' => '12345'], $request->getCompiledQuery());
    }
}
