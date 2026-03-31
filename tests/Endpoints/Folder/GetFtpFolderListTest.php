<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\GetFtpFolderList;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class GetFtpFolderListTest extends TestCase
{
    public function test_without_parameters(): void
    {
        $this->makeBasicAuthEndpointTest(new GetFtpFolderList);
    }
}
