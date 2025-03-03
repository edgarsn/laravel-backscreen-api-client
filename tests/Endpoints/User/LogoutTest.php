<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\User;

use Newman\LaravelBackscreenApiClient\Endpoints\User\Logout;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class LogoutTest extends TestCase
{
    public function test(): void
    {
        $this->makeBearerAuthEndpointTest(new Logout, [], '');
    }
}
