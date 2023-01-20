<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Clients
    |--------------------------------------------------------------------------
    |
    | Configure your default client and optionally add other clients
    | with their credentials.
    |
    */

    'clients' => [
        'default' => [
            // Basic Auth credentials (Required)
            'auth' => [
                'username' => env('TMS_DEFAULT_USERNAME'),
                'password' => env('TMS_DEFAULT_PASSWORD'),
            ],

            // Default HTTP settings (Optional)
            'http' => [
                // Default timeout (in seconds) for the request.
                'timeout' => 15,

                // Default connect timeout (in seconds) for the request.
                'connect_timeout' => 15,
            ],
        ],
    ],
];
