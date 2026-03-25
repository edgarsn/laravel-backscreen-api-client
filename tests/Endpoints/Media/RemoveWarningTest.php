<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\RemoveWarning;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class RemoveWarningTest extends TestCase
{
    public function test_with_basic_auth(): void
    {
        $this->makeBasicAuthEndpointTest(new RemoveWarning(123, 'some_warning'), [], [
            'id' => 123,
            'warning' => 'some_warning',
        ]);
    }

    public function test_with_bearer_auth(): void
    {
        $this->makeBearerAuthEndpointTest(new RemoveWarning(456, 'other_warning'), [], [
            'id' => 456,
            'warning' => 'other_warning',
        ]);
    }
}
