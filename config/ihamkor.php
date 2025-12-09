<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | i-Hamkor API URL
    |--------------------------------------------------------------------------
    |
    | The base URL for the i-Hamkor API service.
    |
    */
    'url' => env('IHAMKOR_URL', 'https://api.i-hamkor.uz/'),

    /*
    |--------------------------------------------------------------------------
    | Client ID
    |--------------------------------------------------------------------------
    |
    | Your i-Hamkor client ID for authentication.
    |
    */
    'client_id' => env('IHAMKOR_CLIENT_ID'),

    /*
    |--------------------------------------------------------------------------
    | Username
    |--------------------------------------------------------------------------
    |
    | Your i-Hamkor username for basic authentication.
    |
    */
    'username' => env('IHAMKOR_USERNAME'),

    /*
    |--------------------------------------------------------------------------
    | Password
    |--------------------------------------------------------------------------
    |
    | Your i-Hamkor password for basic authentication.
    |
    */
    'password' => env('IHAMKOR_PASSWORD'),

    /*
    |--------------------------------------------------------------------------
    | Timeout
    |--------------------------------------------------------------------------
    |
    | Request timeout in seconds.
    |
    */
    'timeout' => env('IHAMKOR_TIMEOUT', 30),

    /*
    |--------------------------------------------------------------------------
    | Retry
    |--------------------------------------------------------------------------
    |
    | Number of retry attempts for failed requests.
    |
    */
    'retry' => [
        'times' => env('IHAMKOR_RETRY_TIMES', 3),
        'sleep' => env('IHAMKOR_RETRY_SLEEP', 100),
    ],
];
