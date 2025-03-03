<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Auth;

use Newman\LaravelBackscreenApiClient\Contracts\AuthMethodContract;
use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

/**
 * @codeCoverageIgnore
 */
class NullAuthMethod implements AuthMethodContract
{
    public function __construct() {}

    public function applyCredentials(PendingRequest $request): void {}

    public function getAuthMethod(): AuthMethodEnum
    {
        return AuthMethodEnum::NULL;
    }
}
