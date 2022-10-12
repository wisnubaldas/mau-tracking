<?php
$conn = [];
$number = env('NUMBER_OF_CONNECTION');

for ($i=0; $i < $number; $i++) { 
    $x = ($i+1);
    $conn[env('DB_CONNECTION_'.$x)] = [
        'driver' => 'mysql',
        'url' => env('DATABASE_URL_'.$x),
        'host' => env('DB_HOST_'.$x, '127.0.0.1'),
        'port' => env('DB_PORT_'.$x, '3306'),
        'database' => env('DB_DATABASE_'.$x, 'forge'),
        'username' => env('DB_USERNAME_'.$x, 'forge'),
        'password' => env('DB_PASSWORD_'.$x, ''),
        'unix_socket' => env('DB_SOCKET_'.$x, ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => null,
    ];
}
return $conn;