# Upgrade from `1.x` to `2.x`
* Rename your laravel config file in `config/tms-api.php` to `config/backscreen-api.php`
* Namespace changed from `Newman\LaravelTmsApiClient` to `Newman\LaravelBackscreenApiClient`. You should update your laravel code to match the new namespace.
* Look-out for usages of `->timeout()`, `->connectTimeout()` and `->withMiddleware()`. They are now only per-request basis and doesn't update globally anymore.
