<?php

namespace CJSN;

use Zend\Cache\StorageFactory;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'Cache' => function($sm) {
                    // Trabalhando com APC

                    $config = $sm->get('Config');
                        $cache = StorageFactory::factory([
                            'adapter' => [
                                'name'    => $config['cache']['adapter'],
                                'options' => [
                                    'ttl' => $config['cache']['ttl']
                                ],
                            ],
                            'plugins' => [
                                'Serializer',
                                'exception_handler' => ['throw_exceptions' => $config['cache']['throw_exceptions']],
                            ],
                        ]);

                        return $cache;

                    /* Trabalhando com memcached

                    $factory = [
                        'adapter' => [
                            'name'    => 'Memcached',
                            'options' => [
                                'ttl' => 10,
                                'servers' => [
                                    ['127.0.0.1', 11211]
                                ]
                            ],
                        ],
                        'plugins' => [
                            'Serializer',
                            'exception_handler' => ['throw_exceptions' => true],// em produção false
                        ],
                    ];
                    $cache = StorageFactory::factory($factory);
                    return $cache;
                    */
                }
            ]
        ];
    }
}
