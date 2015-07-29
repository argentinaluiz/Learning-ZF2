<?php

return [
    'db' => [
        'driver'    => 'Pdo',
        'dsn'       => 'mysql:dbname=zf2_iniciante,host=localhost',
        'driver_options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF-8\''
        ]
    ]
];
