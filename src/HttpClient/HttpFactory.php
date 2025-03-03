<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\HttpClient;

use Illuminate\Http\Client\Factory;

class HttpFactory extends Factory
{
    /**
     * Create a new pending request instance for this factory.
     *
     * @return \Illuminate\Http\Client\PendingRequest
     */
    protected function newPendingRequest()
    {
        return new PendingRequest($this);
    }
}
