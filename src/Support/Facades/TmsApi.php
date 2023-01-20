<?php

declare(strict_types=1);

namespace Newman\LaravelTmsApiClient\Support\Facades;

use Illuminate\Support\Facades\Facade;
use Newman\LaravelTmsApiClient\Contracts\AuthMethodContract;
use Newman\LaravelTmsApiClient\Contracts\ClientContract;
use Newman\LaravelTmsApiClient\Contracts\TmsApiContract;
use Newman\LaravelTmsApiClient\Support\TmsApiFake;

/**
 * @method static ClientContract client(string $name)
 * @method static ClientContract nullClient()
 * @method static ClientContract createClient(string $name, AuthMethodContract $auth)
 * @method static array getClients()
 */
class TmsApi extends Facade
{
    /**
     * Replace the bound instance with a fake.
     *
     * @return TmsApiFake
     */
    public static function fake(): TmsApiFake
    {
        /** @var TmsApiContract $facadeRoot */
        $facadeRoot = static::getFacadeRoot();

        static::swap($fake = new TmsApiFake($facadeRoot));

        return $fake;
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return TmsApiContract::class;
    }
}
