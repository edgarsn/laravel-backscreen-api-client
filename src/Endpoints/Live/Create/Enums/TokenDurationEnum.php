<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Live\Create\Enums;

enum TokenDurationEnum: string
{
    case ONE_HOUR = '1h';
    case THREE_HOUR = '3h';
    case SIX_HOUR = '6h';
    case TWELVE_HOUR = '12h';
    case DAY = '1d';
    case WEEK = '1w';
    case TWO_WEEKS = '2w';
    case MONTH = '1m';
}
