<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\CreateFtpFolder;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class CreateFtpFolderTest extends TestCase
{
    public function test_with_id(): void
    {
        $this->makeBasicAuthEndpointTest(new CreateFtpFolder(123), [], [
            'id' => 123,
        ]);
    }
}
