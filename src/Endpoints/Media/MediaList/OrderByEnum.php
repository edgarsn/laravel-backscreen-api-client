<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\MediaList;

enum OrderByEnum: string
{
    case ID = 'id';
    case NAME = 'name';
    case PG_RATING = 'pg_rating';
    case ASSET_ID = 'asset_id';
    case CAT_ID = 'cat_id';
    case STATUS = 'status';
    case CREATED_AT = 'created_at';
    case UPDATED_AT = 'updated_at';
    case AVAILABILITY_EXPIRE_TIME = 'availability.expire_time';
    case AVAILABILITY_AVAILABLE_TIME = 'availability.available_time';
    case CATEGORY_NAME = 'category.name';
}
