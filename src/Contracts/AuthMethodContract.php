<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Contracts;

use Newman\LaravelTmsApiClient\Enums\AuthMethodEnum;
use Newman\LaravelTmsApiClient\HttpClient\PendingRequest;

interface AuthMethodContract
{
    /**
     * Applies credentials to request specific to this autentication method.
     *
     * @param PendingRequest $request
     * @return void
     */
    public function applyCredentials(PendingRequest $request): void;

    /**
     * Authentication implementation method name.
     *
     * @return AuthMethodEnum
     */
    public function getAuthMethod(): AuthMethodEnum;
}
