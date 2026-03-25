<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\EncryptionMethodEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums\TokenDurationEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Security;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class SecurityTest extends TestCase
{
    public function test_empty(): void
    {
        $security = new Security;
        $this->assertEquals([], $security->compileAsArray());
    }

    public function test_encryption_method(): void
    {
        $security = new Security;
        $security->encryptionMethod(EncryptionMethodEnum::AES);
        $this->assertEquals(['encryption_method' => 'aes'], $security->compileAsArray());
    }

    public function test_token_duration(): void
    {
        $security = new Security;
        $security->tokenDuration(TokenDurationEnum::DAY);
        $this->assertEquals(['token_duration' => '1d'], $security->compileAsArray());
    }

    public function test_use_token(): void
    {
        $security = new Security;
        $security->useToken(1);
        $this->assertEquals(['use_token' => 1], $security->compileAsArray());
    }

    public function test_use_token_invalid(): void
    {
        $security = new Security;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('use_token must be 0 or 1');
        $security->useToken(2);
    }

    public function test_use_token_full(): void
    {
        $security = new Security;
        $security->useTokenFull(0);
        $this->assertEquals(['use_token_full' => 0], $security->compileAsArray());
    }

    public function test_use_token_full_invalid(): void
    {
        $security = new Security;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('use_token_full must be 0 or 1');
        $security->useTokenFull(2);
    }

    public function test_all_fields(): void
    {
        $security = new Security;
        $security->encryptionMethod(EncryptionMethodEnum::DRM)
            ->tokenDuration(TokenDurationEnum::WEEK)
            ->useToken(1)
            ->useTokenFull(0);

        $this->assertEquals([
            'encryption_method' => 'drm',
            'token_duration' => '1w',
            'use_token' => 1,
            'use_token_full' => 0,
        ], $security->compileAsArray());
    }
}
