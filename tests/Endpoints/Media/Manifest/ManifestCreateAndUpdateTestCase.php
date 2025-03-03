<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Manifest;

use Newman\LaravelBackscreenApiClient\Contracts\EndpointContract;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

abstract class ManifestCreateAndUpdateTestCase extends TestCase
{
    public function test_with_required_arguments(): void
    {
        $this->makeBasicAuthEndpointTest($this->getEndpoint(), [], [$this->getIdFieldName() => 123]);
    }

    public function test_with_name(): void
    {
        $endpoint = $this->getEndpoint();

        $endpoint->name('test');

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            $this->getIdFieldName() => 123,
            'name' => 'test',
        ]);
    }

    public function test_with_default(): void
    {
        $endpoint = $this->getEndpoint();

        $endpoint->default(true);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            $this->getIdFieldName() => 123,
            'default' => 1,
        ]);

        $endpoint->default(false);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            $this->getIdFieldName() => 123,
            'default' => 0,
        ]);
    }

    public function test_with_start_at(): void
    {
        $endpoint = $this->getEndpoint();

        $endpoint->startAt(1000);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            $this->getIdFieldName() => 123,
            'start_at' => 1000,
        ]);
    }

    public function test_with_end_at(): void
    {
        $endpoint = $this->getEndpoint();

        $endpoint->endAt(60000);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            $this->getIdFieldName() => 123,
            'end_at' => 60000,
        ]);
    }

    public function test_with_files(): void
    {
        $endpoint = $this->getEndpoint();

        $endpoint->files([1, 2]);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            $this->getIdFieldName() => 123,
            'files' => [1, 2],
        ]);
    }

    public function test_with_package_id(): void
    {
        $endpoint = $this->getEndpoint();

        $endpoint->packageId(1052);

        $this->makeBasicAuthEndpointTest($endpoint, [], [
            $this->getIdFieldName() => 123,
            'package_id' => 1052,
        ]);
    }

    abstract protected function getIdFieldName(): string;

    abstract protected function getEndpoint(): EndpointContract;
}
