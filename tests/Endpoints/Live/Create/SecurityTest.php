<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Live\Create;

use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Enums\EncryptionMethodEnum;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Enums\TokenDurationEnum;
use Newman\LaravelTmsApiClient\Endpoints\Live\Create\Security;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

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
