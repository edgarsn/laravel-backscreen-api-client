<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Support;

use Carbon\Carbon;
use Newman\LaravelTmsApiClient\Concerns\CompilesProperties;
use Newman\LaravelTmsApiClient\Endpoints\Media\MediaList\StatusEnum;

class TestClassWithPropertiesAndExceptProperties
{
    use CompilesProperties;

    protected ?string $name = 'Name';

    protected ?string $description = 'Description';

    protected ?string $emptyName = null;

    protected ?string $status = 'ingested';

    protected ?Carbon $created_at = null;

    protected ?bool $is_published = false;

    protected ?StatusEnum $status_enum = StatusEnum::INGESTED;

    protected ?TestClassWithProperties $child = null;

    /**
     * @var array<TestClassWithProperties>|null
     */
    protected ?array $children = null;

    public function __construct()
    {
        $this->created_at = Carbon::create(2023, 1, 19, 15, 41, 43);
        $this->child = new TestClassWithProperties;

        for ($i = 0; $i < 2; $i++) {
            $this->children[] = new TestClassWithProperties;
        }
    }

    public function compilesAsArrayExceptProperties(): array
    {
        return ['status'];
    }
}
