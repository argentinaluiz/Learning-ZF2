<?php
namespace Acl;

return [
    'router' => [
        'routes' => [
            'acl-admin' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/admin/acl',
                    'defaults' => [
                        '__NAMESPACE__' => 'Acl\Controller',
                        'controller' => 'Roles',
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/[:controller[/:action[/:id]]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Acl\Controller',
                                'controller' => 'roles'
                            ]
                        ]
                    ],
                    'paginator' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/[:controller[/page/:page]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page' => '\d+'
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Acl\Controller',
                                'controller' => 'roles'
                            ]
                        ]
                    ]
                ]
            ]
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Acl\Controller\Roles' => 'Acl\Controller\RolesController',
            'Acl\Controller\Resources' => 'Acl\Controller\ResourcesController',
        ]
    ],
    'service_manager' => [
        'aliases' => [
            'Zend\Authentication\AuthenticationService' => 'authService',
        ],
        'invokables' => [
            'authService' => 'Zend\Authentication\AuthenticationService',
        ],
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
                'extension' => '.dcm.yml',
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
        'User_fixture' => __DIR__ . '/../src/Acl/Fixture',
    ],
];