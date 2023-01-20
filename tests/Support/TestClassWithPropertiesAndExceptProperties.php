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

    public function __construct()
    {
        $this->created_at = Carbon::create(2023, 1, 19, 15, 41, 43);
    }

    public function compilesAsArrayExceptProperties(): array
    {
        return ['status'];
    }
}
