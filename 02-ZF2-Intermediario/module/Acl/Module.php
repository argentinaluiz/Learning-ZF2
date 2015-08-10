<?php

namespace Acl;

use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Acl\Form\Role as FormRole;

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
                'Acl\Form\Role' => function($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $repository = $em->getRepository('Acl\Entity\Role');
                    $parent = $repository->fetchParent();

                    return new FormRole('role', $parent);
                },
                'Acl\Form\Privilege' => function($sm){
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $repoRoles = $em->getRepository('Acl\Entity\Role');
                    $roles = $repoRoles->fetchParent();

                    $repoResources = $em->getRepository('Acl\Entity\Resource');
                    $resources = $repoResources->fetchPairs();

                    return new Form\Privilege("privilege", $roles, $resources);
                },
                'Acl\Service\Role' => function($sm) {
                    return new Service\Role($sm->get('Doctrine\ORM\EntityManager'));
                },
                'Acl\Service\Resource' => function($sm) {
                    return new Service\Resource($sm->get('Doctrine\ORM\EntityManager'));
                },
                'Acl\Service\Privilege' => function($sm) {
                    return new Service\Privilege($sm->get('Doctrine\ORM\EntityManager'));
                }
            ],
        ];
    }
}
