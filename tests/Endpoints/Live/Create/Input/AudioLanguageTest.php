<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Live\Create\Input;

use Newman\LaravelBackscreenApiClient\Endpoints\Live\Create\Input\AudioLanguage;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class AudioLanguageTest extends TestCase
{
    public function test(): void
    {
        $language = new AudioLanguage;

        try {
            $language->language('wrong');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('language must be a 3 character string of ISO 639-2 language code', $e->getMessage());
        }

        try {
            $language->pid('žžžž');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('pid must be an alphanumeric string', $e->getMessage());
        }
    }
}
