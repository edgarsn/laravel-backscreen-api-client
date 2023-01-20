<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Media;

use Newman\LaravelTmsApiClient\Endpoints\Media\Delete;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class DeleteTest extends TestCase
{
    public function test_with_single_id(): void
    {
        $this->makeBasicAuthEndpointTest(new Delete(123), [], ['id' => [123]]);
    }

    public function test_it_accepts_multiple_ids(): void
    {
        $this->makeBasicAuthEndpointTest(new Delete([123, 456]), [], ['id' => [123, 456]]);
    }
}
