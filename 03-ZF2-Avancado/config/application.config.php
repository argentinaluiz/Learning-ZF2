<?php

return [
    'modules' => [
        'Application',
        'DoctrineModule',
        'DoctrineORMModule',
        'DoctrineDataFixtureModule',
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
        ],
    ],
];
