<?php

// Require global config from Phalcon
define(BASEPATH, 'migration');
$config = __DIR__ . '/application/config/database.php';

if (!isset($config)) {
    die('You must create config first in: ' . $config . PHP_EOL);
} else {
    $config   = require_once($config);

    return [
        'paths' => [
            'migrations' => 'application/migrations',
        ],
        'environments' => [
            'default_migration_table' => 'phinxlog',
            'default_database' => 'production',
            'production' => [
                'adapter' => 'mysql',
                'host'    => $db['default']['hostname'],
                'name'    => $db['default']['database'],
                'user'    => $db['default']['username'],
                'pass'    => $db['default']['password']
            ]
        ]
    ];
}