<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Unit;

use Newman\LaravelTmsApiClient\Enums\HttpMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\HttpFactory;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;
use Newman\LaravelTmsApiClient\Tests\TestCase;

class PendingRequestTest extends TestCase
{
    public function test(): void
    {
        $factory = new HttpFactory();
        /** @var PendingRequest $request */
        $request = $factory->baseUrl('https://api.localhost');

        $request->useMethod(HttpMethodEnum::GET);
        $request->setEndpoint('/Test');
        $request->setAuthQueryParams(['auth_token' => 1234]);
        $request->withQuery(['status' => 'ingested']);
        $request->withData(['id' => 5]);

        $this->assertEquals(HttpMethodEnum::GET, $request->getHttpMethod());
        $this->assertEquals('/Test', $request->getEndpoint());
        $this->assertEquals(['auth_token' => 1234, 'status' => 'ingested'], $request->getCompiledQuery());
        $this->assertEquals(['id' => 5], $request->getData());
    }
}
