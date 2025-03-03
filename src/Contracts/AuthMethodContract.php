<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Contracts;

use Newman\LaravelBackscreenApiClient\Enums\AuthMethodEnum;
use Newman\LaravelBackscreenApiClient\HttpClient\PendingRequest;

interface AuthMethodContract
{
    /**
     * Applies credentials to request specific to this autentication method.
     */
    public function applyCredentials(PendingRequest $request): void;

    /**
     * Authentication implementation method name.
     */
    public function getAuthMethod(): AuthMethodEnum;
}
