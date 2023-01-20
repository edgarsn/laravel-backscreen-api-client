<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Token\Generate;

enum SubitemTypeEnum: string
{
    case PLAYBACK_HLS = 'playback_hls';
    case PLAYBACK_DASH = 'playback_dash';
    case MEDIA_SOURCE = 'media_source';
    case MEDIA_TRANSCODE = 'media_transcode';
    case EMBED = 'embed';
    case RECORDING_BITRATE = 'recording_bitrate';
}
