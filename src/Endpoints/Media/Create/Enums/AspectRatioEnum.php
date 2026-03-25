<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums;

enum AspectRatioEnum: string
{
    case RATIO_4_3 = '4:3';
    case RATIO_5_4 = '5:4';
    case RATIO_16_9 = '16:9';
    case RATIO_21_9 = '21:9';
    case RATIO_2_1 = '2:1';
}
