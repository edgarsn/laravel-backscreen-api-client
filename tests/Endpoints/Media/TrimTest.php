<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Tests\Endpoints\Media;

use Newman\LaravelTmsApiClient\Endpoints\Media\Trim;
use Newman\LaravelTmsApiClient\Tests\Endpoints\TestCase;

class TrimTest extends TestCase
{
    public function test_with_required_arguments(): void
    {
        $this->makeBearerAuthEndpointTest(new Trim(123, '00:00:00', '00:10:12', Trim\TypeEnum::EXISTING), [], [
            'id' => 123,
            'start' => '00:00:00',
            'end' => '00:10:12',
            'type' => Trim\TypeEnum::EXISTING->value,
        ]);
    }

    public function test_with_name(): void
    {
        $endpoint = new Trim(123, '00:00:00', '00:10:12', Trim\TypeEnum::EXISTING);

        $endpoint->name('Lorem');

        $this->makeBearerAuthEndpointTest($endpoint, [], [
            'id' => 123,
            'start' => '00:00:00',
            'end' => '00:10:12',
            'type' => Trim\TypeEnum::EXISTING->value,
            'name' => 'Lorem',
        ]);
    }
}
