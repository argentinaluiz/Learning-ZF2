<?php

return [
    'modules' => [
        'Application',
        'DoctrineModule',
        'DoctrineORMModule',
        'Base',
        'CJSN',
    ],
    'module_listener_options' => [
        'module_paths' => [
            './module',
            './vendor',
        ],
        'config_glob_paths' => [
            'config/autoload/{{,*.}global,{,*.}local}.php',
            __DIR__ . '/test.config.php'
        ],
    ],
];
