<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Live\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Live\Create\Enums\EncryptionMethodEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Live\Create\Enums\TokenDurationEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Live\Create\Security;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class SecurityTest extends TestCase
{
    public function test(): void
    {
        $security = new Security;

        $security->encryptionMethod(EncryptionMethodEnum::AES)
            ->useToken(true)
            ->tokenDuration(TokenDurationEnum::ONE_HOUR);

        $this->assertEquals([
            'encryption_method' => 'aes',
            'use_token' => 1,
            'token_duration' => '1h',
        ], $security->compileAsArray());
    }
}
