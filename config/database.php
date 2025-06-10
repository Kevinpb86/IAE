'connections' => [

    // ... other connections ...

    'admin' => [
        'driver' => 'mysql',
        'url' => env('DATABASE_URL'),
        'host' => env('ADMIN_DB_HOST', '127.0.0.1'),
        'port' => env('ADMIN_DB_PORT', '3306'),
        'database' => env('ADMIN_DB_DATABASE', 'forge'),
        'username' => env('ADMIN_DB_USERNAME', 'forge'),
        'password' => env('ADMIN_DB_PASSWORD', ''),
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
    ],

], 