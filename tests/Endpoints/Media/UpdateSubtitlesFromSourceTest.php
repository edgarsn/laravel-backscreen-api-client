<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\UpdateSubtitlesFromSource;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class UpdateSubtitlesFromSourceTest extends TestCase
{
    public function test_with_required_arguments(): void
    {
        $this->makeBearerAuthEndpointTest(new UpdateSubtitlesFromSource(123), [], ['id' => 123]);
    }
}
