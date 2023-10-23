<?php

use Illuminate\Support\Str;

return [
    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */
    'connections' => [
        'common_db' => [
            'driver' => 'mysql',
            'host' => env('ID_DB_HOST', '127.0.0.1'),
            'port' => env('ID_DB_PORT', 3306),
            'database' => env('ID_DB_DATABASE', 'forge'),
            'username' => env('ID_DB_USERNAME', 'forge'),
            'password' => env('ID_DB_PASSWORD', ''),
            'unix_socket' => env('ID_DB_SOCKET', ''),
            'charset' => env('ID_DB_CHARSET', 'utf8mb4'),
            'collation' => env('ID_DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => env('ID_DB_PREFIX', ''),
            'strict' => env('ID_DB_STRICT_MODE', true),
            'engine' => env('ID_DB_ENGINE', null),
            'timezone' => env('ID_DB_TIMEZONE', '+00:00'),
        ],
    ],
];
