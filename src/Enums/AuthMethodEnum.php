<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Enums;

enum AuthMethodEnum
{
    case BASIC;
    case BEARER;
    case API_KEY;
    case NULL;
}
