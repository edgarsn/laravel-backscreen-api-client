<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Live\LiveList;

enum PeriodEnum: string
{
    case THIS_HOUR = 'this hour';
    case LAST_HOUR = 'last hour';
    case TODAY = 'today';
    case YESTERDAY = 'yesterday';
    case LAST_7_DAYS = 'last 7 days';
    case LAST_15_DAYS = 'last 15 days';
    case LAST_30_DAYS = 'last 30 days';
    case LAST_60_DAYS = 'last 60 days';
    case THIS_WEEK = 'this week';
    case LAST_WEEK = 'last week';
    case THIS_MONTH = 'this month';
    case LAST_MONTH = 'last month';
    case LAST_2_MONTHS = 'last 2 months';
    case LAST_3_MONTHS = 'last 3 months';
    case LAST_6_MONTHS = 'last 6 months';
    case THIS_YEAR = 'this year';
    case LAST_YEAR = 'last year';
}
