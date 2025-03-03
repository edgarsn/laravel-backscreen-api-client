<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Endpoints\Live\LiveList;

enum ReturnEnum: string
{
    case PUBLISH = 'publish';
    case CATEGORY = 'category';
    case EMBED = 'embed';
    case URLS = 'urls';
    case PREVIEW = 'preview';
    case MANIFESTS = 'manifests';
    case SECURITY = 'security';
    case PLAYER = 'player';
    case IMAGES = 'images';
    case IMAGES_INFO = 'images.info';
    case AVAILABILITY = 'availability';
    case ADS = 'ads';
    case BITRATES = 'bitrates';
    case BITRATES_CUSTOM = 'bitrates.custom';
    case BITRATES_VIDEO = 'bitrates.video';
    case BITRATES_AUDIO = 'bitrates.audio';
    case BITRATES_RESTREAMS = 'bitrates.restreams';
    case RECORDING = 'recording';
    case RECORDING_NIMBUS = 'recording.nimbus';
    case RECORDING_EPG = 'recording.epg';
    case INPUT = 'input';
    case ADMIN = 'admin';
}
