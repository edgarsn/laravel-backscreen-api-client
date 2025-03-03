<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Tests\Endpoints\Live\Create;

use Newman\LaravelBackscreenApiClient\Endpoints\Live\Create\Recording\EPG;
use Newman\LaravelBackscreenApiClient\Endpoints\Live\Create\Recording\Nimbus;
use Newman\LaravelBackscreenApiClient\Endpoints\Live\Create\Recording\Recording;
use Newman\LaravelBackscreenApiClient\Tests\Endpoints\TestCase;

class RecordingTest extends TestCase
{
    public function test(): void
    {
        $recording = new Recording;
        $recording->autoDelete(true);
        $recording->autoDeleteMedia(true);
        $recording->savePassed(true);
        $recording->deleteAfterHours(10);
        $recording->marginStartSeconds(10);
        $recording->marginEndSeconds(10);
        $recording->fileNamingPattern('file_naming_pattern');

        $nimbus = new Nimbus;
        $nimbus->syncInterval(1);
        $nimbus->channelId(1);
        $nimbus->manifestId(1);

        $epg = new EPG;
        $epg->hoursBefore(1);
        $epg->hoursAfter(1);
        $epg->round(1);

        $recording->nimbus($nimbus);
        $recording->epg($epg);

        $this->assertEquals([
            'auto_delete' => true,
            'auto_delete_media' => true,
            'save_passed' => true,
            'delete_after_hours' => 10,
            'margin_start_seconds' => 10,
            'margin_end_seconds' => 10,
            'file_naming_pattern' => 'file_naming_pattern',
            'nimbus' => [
                'sync_interval' => 1,
                'channel_id' => 1,
                'manifest_id' => 1,
            ],
            'epg' => [
                'hours_before' => 1,
                'hours_after' => 1,
                'round' => 1,
            ],
        ], $recording->compileAsArray());
    }
}
