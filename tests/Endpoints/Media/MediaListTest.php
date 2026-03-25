<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Media;

use Carbon\Carbon;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList\FileExtension;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList\MediaInfo;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList\PeriodEnum;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList\Popular;
use Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList\PopularSourceEnum;
use Newman\LaravelBackscreenApiClient\EndpointSupport\Enums\OrderDirectionEnum;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class MediaListTest extends TestCase
{
    public function test_without_parameters(): void
    {
        $this->makeBasicAuthEndpointTest(new MediaList);
    }

    public function test_with_ids(): void
    {
        $endpoint = new MediaList;

        $endpoint->ids([1, 2]);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'id' => [1, 2],
        ]);
    }

    public function test_with_asset_ids(): void
    {
        $endpoint = new MediaList;

        $endpoint->assetIds(['99_abc', '10_def']);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'asset_id' => ['99_abc', '10_def'],
        ]);
    }

    public function test_with_category_ids(): void
    {
        $endpoint = new MediaList;

        $endpoint->categoryIds([1, 2]);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'cat_id' => [1, 2],
        ]);
    }

    public function test_with_created_from(): void
    {
        $endpoint = new MediaList;

        // unix
        $endpoint->createdFrom(1674135633);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'created_from' => 1674135633,
        ]);

        // string
        $endpoint->createdFrom('2023-01-19 15:41:43');

        $this->makeBasicAuthEndpointTest($endpoint, [
            'created_from' => '2023-01-19 15:41:43',
        ]);

        // Carbon
        $endpoint->createdFrom(Carbon::create(2023, 1, 19, 15, 41, 43));

        $this->makeBasicAuthEndpointTest($endpoint, [
            'created_from' => '2023-01-19 15:41:43',
        ]);
    }

    public function test_with_created_to(): void
    {
        $endpoint = new MediaList;

        // unix
        $endpoint->createdTo(1674135633);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'created_to' => 1674135633,
        ]);

        // string
        $endpoint->createdTo('2023-01-19 15:41:43');

        $this->makeBasicAuthEndpointTest($endpoint, [
            'created_to' => '2023-01-19 15:41:43',
        ]);

        // Carbon
        $endpoint->createdTo(Carbon::create(2023, 1, 19, 15, 41, 43));

        $this->makeBasicAuthEndpointTest($endpoint, [
            'created_to' => '2023-01-19 15:41:43',
        ]);
    }

    public function test_with_updated_from(): void
    {
        $endpoint = new MediaList;

        // unix
        $endpoint->updatedFrom(1674135633);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'updated_from' => 1674135633,
        ]);

        // string
        $endpoint->updatedFrom('2023-01-19 15:41:43');

        $this->makeBasicAuthEndpointTest($endpoint, [
            'updated_from' => '2023-01-19 15:41:43',
        ]);

        // Carbon
        $endpoint->updatedFrom(Carbon::create(2023, 1, 19, 15, 41, 43));

        $this->makeBasicAuthEndpointTest($endpoint, [
            'updated_from' => '2023-01-19 15:41:43',
        ]);
    }

    public function test_with_updated_to(): void
    {
        $endpoint = new MediaList;

        // unix
        $endpoint->updatedTo(1674135633);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'updated_to' => 1674135633,
        ]);

        // string
        $endpoint->updatedTo('2023-01-19 15:41:43');

        $this->makeBasicAuthEndpointTest($endpoint, [
            'updated_to' => '2023-01-19 15:41:43',
        ]);

        // Carbon
        $endpoint->updatedTo(Carbon::create(2023, 1, 19, 15, 41, 43));

        $this->makeBasicAuthEndpointTest($endpoint, [
            'updated_to' => '2023-01-19 15:41:43',
        ]);
    }

    public function test_with_published(): void
    {
        $endpoint = new MediaList;

        $endpoint->published(true);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'published' => 1,
        ]);

        $endpoint->published(false);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'published' => 0,
        ]);
    }

    public function test_with_publisher_status(): void
    {
        $endpoint = new MediaList;

        $endpoint->publisherStatus(MediaList\PublisherStatusEnum::SCHEDULED);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'publisher_status' => MediaList\PublisherStatusEnum::SCHEDULED->value,
        ]);
    }

    public function test_with_only_available(): void
    {
        $endpoint = new MediaList;

        $endpoint->onlyAvailable(true);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'only_available' => 1,
        ]);

        $endpoint->onlyAvailable(false);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'only_available' => 0,
        ]);
    }

    public function test_with_search(): void
    {
        $endpoint = new MediaList;

        $endpoint->search('lorem ipsum');

        $this->makeBasicAuthEndpointTest($endpoint, [
            'search' => 'lorem ipsum',
        ]);
    }

    public function test_with_status(): void
    {
        $endpoint = new MediaList;

        $endpoint->status(MediaList\StatusEnum::APPROVED);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'status' => [MediaList\StatusEnum::APPROVED->value],
        ]);

        $endpoint->status([MediaList\StatusEnum::INGESTED, MediaList\StatusEnum::NEW]);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'status' => [MediaList\StatusEnum::INGESTED->value, MediaList\StatusEnum::NEW->value],
        ]);
    }

    public function test_with_tags(): void
    {
        $endpoint = new MediaList;

        $endpoint->tags(['lorem', 'ipsum']);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'tags' => ['lorem', 'ipsum'],
        ]);
    }

    public function test_with_limit(): void
    {
        $endpoint = new MediaList;

        $endpoint->limit(5);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'limit' => 5,
        ]);
    }

    public function test_with_limit_out_of_bounds_exception(): void
    {
        $endpoint = new MediaList;

        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage('Limit must be between 1 and 50.');

        $endpoint->limit(1000);
    }

    public function test_with_offset(): void
    {
        $endpoint = new MediaList;

        $endpoint->offset(5);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'offset' => 5,
        ]);
    }

    public function test_with_order_by(): void
    {
        $endpoint = new MediaList;

        $endpoint->orderBy(MediaList\OrderByEnum::CREATED_AT);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'order_by' => MediaList\OrderByEnum::CREATED_AT->value,
        ]);
    }

    public function test_with_order_dir(): void
    {
        $endpoint = new MediaList;

        $endpoint->orderDir(OrderDirectionEnum::ASC);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'order_dir' => OrderDirectionEnum::ASC->value,
        ]);
    }

    public function test_with_images_fallback(): void
    {
        $endpoint = new MediaList;

        $endpoint->imagesFallback(true);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'images_fallback' => 1,
        ]);

        $endpoint->imagesFallback(false);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'images_fallback' => 0,
        ]);
    }

    public function test_with_return(): void
    {
        $endpoint = new MediaList;

        $endpoint->return(['actions', 'tech_status']);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'return' => ['actions', 'tech_status'],
        ]);
    }

    public function test_with_id_from(): void
    {
        $endpoint = new MediaList;
        $endpoint->idFrom(100);

        $this->makeBasicAuthEndpointTest($endpoint, ['id_from' => 100]);
    }

    public function test_with_id_to(): void
    {
        $endpoint = new MediaList;
        $endpoint->idTo(500);

        $this->makeBasicAuthEndpointTest($endpoint, ['id_to' => 500]);
    }

    public function test_with_created_period(): void
    {
        $endpoint = new MediaList;
        $endpoint->createdPeriod(PeriodEnum::LAST_7_DAYS);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'created_period' => PeriodEnum::LAST_7_DAYS->value,
        ]);
    }

    public function test_with_updated_period(): void
    {
        $endpoint = new MediaList;
        $endpoint->updatedPeriod(PeriodEnum::THIS_MONTH);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'updated_period' => PeriodEnum::THIS_MONTH->value,
        ]);
    }

    public function test_with_published_from(): void
    {
        $endpoint = new MediaList;
        $endpoint->publishedFrom('2023-01-01 00:00:00');

        $this->makeBasicAuthEndpointTest($endpoint, [
            'published_from' => '2023-01-01 00:00:00',
        ]);
    }

    public function test_with_published_to(): void
    {
        $endpoint = new MediaList;
        $endpoint->publishedTo(Carbon::create(2023, 6, 30, 23, 59, 59));

        $this->makeBasicAuthEndpointTest($endpoint, [
            'published_to' => '2023-06-30 23:59:59',
        ]);
    }

    public function test_with_published_period(): void
    {
        $endpoint = new MediaList;
        $endpoint->publishedPeriod(PeriodEnum::LAST_30_DAYS);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'published_period' => PeriodEnum::LAST_30_DAYS->value,
        ]);
    }

    public function test_with_name_string(): void
    {
        $endpoint = new MediaList;
        $endpoint->name('Test%');

        $this->makeBasicAuthEndpointTest($endpoint, ['name' => 'Test%']);
    }

    public function test_with_name_array(): void
    {
        $endpoint = new MediaList;
        $endpoint->name(['Test%', 'Demo%']);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'name' => ['Test%', 'Demo%'],
        ]);
    }

    public function test_with_pg_rating(): void
    {
        $endpoint = new MediaList;
        $endpoint->pgRating('PG-13');

        $this->makeBasicAuthEndpointTest($endpoint, ['pg_rating' => 'PG-13']);
    }

    public function test_with_status_exclude(): void
    {
        $endpoint = new MediaList;
        $endpoint->statusExclude(MediaList\StatusEnum::ARCHIVED);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'status_exclude' => [MediaList\StatusEnum::ARCHIVED->value],
        ]);
    }

    public function test_with_tech_status(): void
    {
        $endpoint = new MediaList;
        $endpoint->techStatus(['transcoded', 'published']);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'tech_status' => ['transcoded', 'published'],
        ]);
    }

    public function test_with_tech_status_exclude(): void
    {
        $endpoint = new MediaList;
        $endpoint->techStatusExclude(['error', 'warning']);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'tech_status_exclude' => ['error', 'warning'],
        ]);
    }

    public function test_with_errors_warnings(): void
    {
        $endpoint = new MediaList;
        $endpoint->errorsWarnings(['missing_thumbnail']);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'errors_warnings' => ['missing_thumbnail'],
        ]);
    }

    public function test_with_file_extension(): void
    {
        $endpoint = new MediaList;

        $fileExtension = new FileExtension;
        $fileExtension->source(['mp4', 'mov']);

        $endpoint->fileExtension($fileExtension);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'file_extension' => ['source' => ['mp4', 'mov']],
        ]);
    }

    public function test_with_empty_file_extension(): void
    {
        $endpoint = new MediaList;
        $endpoint->fileExtension(new FileExtension);

        $this->makeBasicAuthEndpointTest($endpoint, []);
    }

    public function test_with_media_info(): void
    {
        $endpoint = new MediaList;

        $mediaInfo = new MediaInfo;
        $mediaInfo->resolution(['1920x1080'])->codec(['h264']);

        $endpoint->mediaInfo($mediaInfo);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'media_info' => [
                'resolution' => ['1920x1080'],
                'codec' => ['h264'],
            ],
        ]);
    }

    public function test_with_popular(): void
    {
        $endpoint = new MediaList;

        $popular = new Popular;
        $popular->source(PopularSourceEnum::YOUBORA)
            ->dateFrom('2023-01-01')
            ->dateTo('2023-12-31')
            ->orderDir(OrderDirectionEnum::DESC);

        $endpoint->popular($popular);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'popular' => [
                'source' => 'youbora',
                'date_from' => '2023-01-01',
                'date_to' => '2023-12-31',
                'order_dir' => 'desc',
            ],
        ]);
    }

    public function test_with_popular_period(): void
    {
        $endpoint = new MediaList;

        $popular = new Popular;
        $popular->source(PopularSourceEnum::INTERNAL)->datePeriod(PeriodEnum::LAST_7_DAYS);

        $endpoint->popular($popular);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'popular' => [
                'source' => 'internal',
                'date_period' => 'last 7 days',
            ],
        ]);
    }

    public function test_with_order_specific(): void
    {
        $endpoint = new MediaList;
        $endpoint->orderSpecific([3, 1, 2]);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'order_specific' => [3, 1, 2],
        ]);
    }

    public function test_with_metadata(): void
    {
        $endpoint = new MediaList;
        $endpoint->metadata(['custom_field' => 'value']);

        $this->makeBasicAuthEndpointTest($endpoint, [
            'metadata' => ['custom_field' => 'value'],
        ]);
    }

    public function test_with_timezone(): void
    {
        $endpoint = new MediaList;
        $endpoint->timezone('Europe/Riga');

        $this->makeBasicAuthEndpointTest($endpoint, ['timezone' => 'Europe/Riga']);
    }
}
