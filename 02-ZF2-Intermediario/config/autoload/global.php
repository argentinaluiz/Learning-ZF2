<?php

return [
    'mail' => [
        'name' => 'gmail',
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'connection_class' => 'login',
        'connection_config' => [
            'username' => '',
            'password' => '',
            'ssl' => 'tls',
            'from' => '',
        ]

    ]
];
