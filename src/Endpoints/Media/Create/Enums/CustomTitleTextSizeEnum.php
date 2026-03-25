<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Endpoints\Media\Create\Enums;

enum CustomTitleTextSizeEnum: string
{
    /** XS */
    case SIZE_0_8 = '0.8';
    /** S */
    case SIZE_1 = '1';
    /** M */
    case SIZE_1_2 = '1.2';
    /** L */
    case SIZE_1_4 = '1.4';
}
