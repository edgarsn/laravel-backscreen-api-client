<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Auth;

use Newman\LaravelTmsApiClient\Contracts\AuthMethodContract;
use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

/**
 * @codeCoverageIgnore
 */
class NullAuthMethod implements AuthMethodContract
{
    public function __construct()
    {
    }

    public function applyCredentials(PendingRequest $request): void
    {

    }

    public function getAuthMethod(): AuthMethodEnum
    {
        return AuthMethodEnum::NULL;
    }
}
