<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\HttpClient;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Support\Collection;

class HttpFactory extends Factory
{
    /**
     * Create a new pending request instance for this factory.
     *
     * @return \Illuminate\Http\Client\PendingRequest
     */
    protected function newPendingRequest()
    {
        return (new PendingRequest($this))->preventStrayRequests(false);
    }

    /**
     * Register a stub callable that will intercept requests and be able to return stub responses.
     *
     * @param  callable(Request $request, array<string, mixed> $options): (\Closure|PromiseInterface|Response|null)|array<string, int|string|\Closure|Response|ResponseSequence|PromiseInterface>|null  $callback
     * @return $this
     */
    public function fake($callback = null)
    {
        $this->stubCallbacks = new Collection;

        return parent::fake($callback);
    }
}
