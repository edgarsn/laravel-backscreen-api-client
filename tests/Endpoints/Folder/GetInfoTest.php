<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\GetInfo;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\GetInfo\ReturnEnum;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class GetInfoTest extends TestCase
{
    public function test_without_parameters(): void
    {
        $this->makeBasicAuthEndpointTest(new GetInfo);
    }

    public function test_with_return_single_enum(): void
    {
        $endpoint = new GetInfo;
        $endpoint->return(ReturnEnum::MULTI_AUDIO);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'return' => ['multi_audio'],
        ]);
    }

    public function test_with_return_array_of_enums(): void
    {
        $endpoint = new GetInfo;
        $endpoint->return([ReturnEnum::DEFAULT_OUTGOING_PATTERNS, ReturnEnum::MULTI_AUDIO]);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'return' => ['default_outgoing_patterns', 'multi_audio'],
        ]);
    }

    public function test_with_return_null(): void
    {
        $endpoint = new GetInfo;
        $endpoint->return(ReturnEnum::MULTI_AUDIO);
        $endpoint->return(null);

        $this->makeBasicAuthEndpointTest($endpoint);
    }
}
