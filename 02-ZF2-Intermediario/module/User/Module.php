<?php

namespace User;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

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
                'User\Mail\Transport' => function($sm) {
                    $config = $sm->get('Config');
                    $options = new SmtpOptions($config['mail']);

                    $transport = new SmtpTransport();
                    $transport->setOptions($options);

                    return $transport;
                },
                'User\Service\User' => function ($sm) {
                    return new Service\User(
                        $sm->get('Doctrine\ORM\EntityManager'),
                        $sm->get('Use\Mail\Transport'),
                        $sm->get('View')
                    );
                }
            ]
        ];
    }
}
