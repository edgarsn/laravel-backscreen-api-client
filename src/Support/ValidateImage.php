<?php

declare(strict_types=1);

namespace Newman\LaravelBackscreenApiClient\Support;

class ValidateImage
{
    /**
     * Verify that the given value is a valid base64 encoded image string
     * in data URI format (e.g. data:image/png;base64,<base64>).
     */
    public static function verify(?string $value): bool
    {
        if ($value === null) {
            return false;
        }

        if (! str_contains($value, 'data:') || ! str_contains($value, 'base64,')) {
            return false;
        }

        $base64 = substr($value, strpos($value, 'base64,') + \strlen('base64,'));

        $decoded = base64_decode($base64, true);

        if ($decoded === false) {
            return false;
        }

        return base64_encode($decoded) === $base64;
    }
}
