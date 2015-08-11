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
                    $cache = StorageFactory::factory(
                        [
                            'adapter' => 'apc',
                            'options' => [
                                'ttl' => 10
                            ],
                            'plugins' => [
                                'exception_handler' => [
                                    'throw_exceptions' => true,
                                    'Serializer'
                                ]
                            ]
                        ]
                    );

                    return $cache;
                }
            ]
        ];
    }
}
