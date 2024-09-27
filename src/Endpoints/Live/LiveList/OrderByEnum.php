<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Live\LiveList;

enum OrderByEnum: string
{
    case ID = 'id';
    case NAME = 'name';
    case CATEGORY_ID = 'cat_id';
    case AVAIL_SCHED_START = 'availability.schedule_start';
    case AVAIL_SCHED_END = 'availability.schedule_end';
    case UPDATED_AT = 'updated_at';
    case CREATED_AT = 'created_at';
}