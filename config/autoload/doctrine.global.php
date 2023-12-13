<?php

declare(strict_types=1);

return [
    'doctrine' => [
        'connection' => [
            'params' => [
                'charset' => 'utf8mb4',
                'serverVersion' => '8.0',
                'driver' => 'pdo_mysql',
                'host' => 'drink_db',
                'port' => 3306,
                'user'     => 'drinkuser',
                'password' => 'drinkpw',
                'dbname'   => 'drinkdb',
                'postConnectQueries' => [
                    'max_execution_time' => 'SET SESSION MAX_EXECUTION_TIME=' . 30 * 60 * 1000,
                ],
                'driverOptions' => [PDO::MYSQL_ATTR_MULTI_STATEMENTS => true],
            ],
        ],
        'migrations' => [
            'migrations_paths' => [
                'App\Storage\Migrations' => 'modules/App/src/Storage/Migrations',
            ],
            'transactional' => true,
            'check_database_platform' => true,
        ],
        'configuration' => [
            'proxy_dir' => __DIR__ . '/../../data/cache',
            'paths' => [
                'modules/App/src/Storage/Components'
            ],
        ]
    ],
];
