<?php

namespace Bookstore;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/bookstore',
                    'defaults' => array(
                        'controller' => 'Bookstore\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'home-admin' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/[:controller[/:action]]',
                    'defaults' => array(
                        'action' => 'index'
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Bookstore\Controller\Index' => 'Bookstore\Controller\IndexController',
            'categorias' => 'BookstoreAdmin\Controller\CategoriesController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'bookstore/index/index' => __DIR__ . '/../view/bookstore/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),

//    DOCTRINE

//    MAPPING ANNOTATION
//    'doctrine' => array(
//        'driver' => array(
//            __NAMESPACE__ . '_driver' => array(
//                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
//                'cache' => 'array',
//                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
//            ),
//            'orm_default' => array(
//                'drivers' => array(
//                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
//                ),
//            ),
//        ),
//    ),

//    MAPPING YAML
    'doctrine' => array(
        'driver' => array(
            '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\YamlDriver',
                'cache' => 'array',
                'extension' => '.orm.yml',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Resources/config/doctrine/')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => '_driver',
                ),
            ),
        ),
    ),
);
