<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Enums\EncryptionMethodEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Enums\TokenDurationEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Security;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class SecurityTest extends TestCase
{
    public function test_empty(): void
    {
        $security = new Security;
        $this->assertEquals([], $security->compileAsArray());
    }

    public function test_encryption_method_drm(): void
    {
        $security = new Security;
        $security->encryptionMethod(EncryptionMethodEnum::DRM);
        $this->assertEquals(['encryption_method' => 'drm'], $security->compileAsArray());
    }

    public function test_encryption_method_aes(): void
    {
        $security = new Security;
        $security->encryptionMethod(EncryptionMethodEnum::AES);
        $this->assertEquals(['encryption_method' => 'aes'], $security->compileAsArray());
    }

    public function test_encryption_method_drmaes(): void
    {
        $security = new Security;
        $security->encryptionMethod(EncryptionMethodEnum::DRMAES);
        $this->assertEquals(['encryption_method' => 'drmaes'], $security->compileAsArray());
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

    public function test_token_duration(): void
    {
        $security = new Security;
        $security->tokenDuration(TokenDurationEnum::DAY);
        $this->assertEquals(['token_duration' => '1d'], $security->compileAsArray());
    }

    public function test_token_duration_week(): void
    {
        $security = new Security;
        $security->tokenDuration(TokenDurationEnum::WEEK);
        $this->assertEquals(['token_duration' => '1w'], $security->compileAsArray());
    }

    public function test_all_fields(): void
    {
        $security = new Security;
        $security->encryptionMethod(EncryptionMethodEnum::DRM)
            ->useToken(1)
            ->useTokenFull(0)
            ->tokenDuration(TokenDurationEnum::ONE_HOUR);

        $this->assertEquals([
            'encryption_method' => 'drm',
            'use_token' => 1,
            'use_token_full' => 0,
            'token_duration' => '1h',
        ], $security->compileAsArray());
    }
}
