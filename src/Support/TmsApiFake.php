<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Support;

use Newman\LaravelTmsApiClient\Contracts\TmsApiContract;

class TmsApiFake
{
    private TmsApiContract $dispatcher;

    public function __construct(TmsApiContract $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param string $method
     * @param array<string, mixed> $args
     * @return mixed
     */
    public function __call(string $method, array $args): mixed
    {
        return $this->dispatcher->$method(...$args);
    }
}
