<?php

namespace Bookstore;

use Bookstore\Service\Category as CategoryService;
use Bookstore\Service\Book as BookService;
use Bookstore\Service\User as UserService;

use BookstoreAdmin\Form\Book as BookForm;

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
                    __NAMESPACE__ . 'Admin' => __DIR__ . '/src/' . __NAMESPACE__ . 'Admin',
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'Bookstore\Service\Category' => function($service) {
                    return new CategoryService($service->get('Doctrine\ORM\EntityManager'));
                },
                'Bookstore\Service\Book' => function($service) {
                    return new BookService($service->get('Doctrine\ORM\EntityManager'));
                },
                'BookstoreAdmin\Form\Book' => function($service) {
                    $em = $service->get('Doctrine\ORM\EntityManager');
                    $repository = $em->getRepository('Bookstore\Entity\Category');
                    $categories = $repository->fetchPairs();
                    return new BookForm(null, $categories);
                },
                'Bookstore\Service\User' => function($service) {
                    return new UserService($service->get('Doctrine\ORM\EntityManager'));
                },
            ]
        ];
    }
}
