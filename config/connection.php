<?php
$conn = [];
$number = env('NUMBER_OF_CONNECTION');

if(env('READ_WRITE_CONN')){
    $conn['mysql'] = [
        'driver' => 'mysql',
        'url' => env('DATABASE_URL'),
        'read' => [
            'host' => [
                env('DB_READ_HOST', '127.0.0.1'), // rw koneksi
            ],
        ],
        'write' => [
            'host' => [
                env('DB_HOST', '127.0.0.1'),
            ],
        ],
        'sticky' => true,
        // 'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'forge'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => null,
        'options' => extension_loaded('pdo_mysql') ? array_filter([
            PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
        ]) : [],
    ];

    for ($i=0; $i < $number; $i++) { 
        $x = ($i+1);
        $conn[env('DB_CONNECTION_'.$x)] = [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_'.$x),
            'read' => [
                'host' => [
                    env('DB_READ_HOST_'.$x, '127.0.0.1'),
                ],
            ],
            'write' => [
                'host' => [
                    env('DB_HOST_'.$x, '127.0.0.1'),
                ],
            ],
            'sticky' => true,
            // 'host' => env('DB_HOST_'.$x, '127.0.0.1'),
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
}else{
    $conn['mysql'] = [
        'driver' => 'mysql',
        'url' => env('DATABASE_URL'),
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'forge'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => null,
        'options' => extension_loaded('pdo_mysql') ? array_filter([
            PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
        ]) : [],
    ];
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
}
return $conn;