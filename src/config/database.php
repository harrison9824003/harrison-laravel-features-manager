<?php

return [
    'driver' => 'mysql',
    'url' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_URL'),
    'host' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_HOST', '127.0.0.1'),
    'port' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_PORT', '3306'),
    'database' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_DATABASE', 'laravel_package'),
    'username' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_USERNAME', 'root'),
    'password' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_PASSWORD', '123456'),
    'unix_socket' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_SOCKET', ''),
    'charset' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_CHARSET', 'utf8mb4'),
    'collation' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_COLLATION', 'utf8mb4_unicode_ci'),
    'prefix' => '',
    'prefix_indexes' => true,
    'strict' => true,
    'engine' => null,
    'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
    ]) : [],
];
