<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Folder\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Folder\Create\Language;
use Newman\LaravelBackscreenApiClient\Tests\TestCase;

class LanguageTest extends TestCase
{
    public function test_empty(): void
    {
        $language = new Language;
        $this->assertEquals([], $language->compileAsArray());
    }

    public function test_default(): void
    {
        $language = new Language;
        $language->default('en');
        $this->assertEquals(['default' => 'en'], $language->compileAsArray());
    }

    public function test_order(): void
    {
        $language = new Language;
        $language->order('en,lv,ru');
        $this->assertEquals(['order' => 'en,lv,ru'], $language->compileAsArray());
    }

    public function test_all_fields(): void
    {
        $language = new Language;
        $language->default('lv')->order('lv,en');

        $this->assertEquals([
            'default' => 'lv',
            'order' => 'lv,en',
        ], $language->compileAsArray());
    }
}
