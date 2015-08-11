<?php

return [
    'controllers' => [
        'invokables' => [
            'UserRest\Controller\UserRest' => 'UserRest\Controller\UserRestController',
        ]
    ],
    'router' => [
        'routes' => [
            'user-rest' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/user[/:id]',
                    'constraints' => [
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => 'UserRest\Controller\UserRest'
                    ]
                ]
            ]
        ]
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy'
        ]
    ],
    // MAPPING DOCTRINE WITH YAML
    'doctrine' => [
        'driver' => [
            '_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\YamlDriver',
                'cache' => 'array',
                'extension' => '.dcm.yml',
                'paths' => [
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Resources/config/doctrine/'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'User\Entity' => 'User' . '_driver',
                ],
            ],
        ],
    ],
];
