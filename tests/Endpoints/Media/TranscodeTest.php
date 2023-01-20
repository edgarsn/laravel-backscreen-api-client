<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Media;

use Newman\LaravelTmsApiClient\Endpoints\Media\Transcode;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class TranscodeTest extends TestCase
{
    public function test_with_required_arguments(): void
    {
        $this->makeBearerAuthEndpointTest(new Transcode(123), [], ['id' => 123]);
    }
}
