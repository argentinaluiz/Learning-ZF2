<?php
namespace User;

return [
    'router' => [
        'routes' => [
            'user-register' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/register',
                    '__NAMESPACE__' => 'User/Controller',
                    'controller' => 'Index',
                    'action' => 'register'
                ]
            ]
        ]
    ],
    'controllers' => [
        'invokables' => [
            'User\Controller\Index' => 'User\Controller\IndexController',
            ''
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    //    MAPPING DOCTRINE WITH YAML
    'doctrine' => [
        'driver' => [
            '_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\YamlDriver',
                'cache' => 'array',
                'extension' => '.orm.yml',
                'paths' => [
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Resources/config/doctrine/'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => '_driver',
                ],
            ],
        ],
    ],
    'data-fixture' => [
        'User_fixture' => __DIR__ . '/../src/User/Fixture',
    ],
];