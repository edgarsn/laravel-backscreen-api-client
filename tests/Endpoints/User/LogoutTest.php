<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\User;

use Newman\LaravelTmsApiClient\Endpoints\User\Logout;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class LogoutTest extends TestCase
{
    public function test(): void
    {
        $this->makeBearerAuthEndpointTest(new Logout(), [], '');
    }
}
