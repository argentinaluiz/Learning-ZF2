<?php

namespace Bookstore;

use Bookstore\Service\Category as CategoryService;
use Bookstore\Service\Book as BookService;
use Bookstore\Service\User as UserService;
use Bookstore\Auth\Adapter as AuthAdapter;

use BookstoreAdmin\Form\Book as BookForm;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap($e) {
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
            $controller = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            $config = $e->getApplication()->getServiceManager()->get('config');
            if (isset($config['module_layouts'][$moduleNamespace])) {
                $controller->layout($config['module_layouts'][$moduleNamespace]);
            }
        }, 98);
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

    public function init(ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();

        $sharedEvents->attach("BookstoreAdmin", 'dispatch', function($e) {
            $auth = new AuthenticationService();
            $auth->setStorage(new SessionStorage("BookstoreAdmin"));

            $controller = $e->getTarget();
            $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();

            if (!$auth->hasIdentity() and ($matchedRoute == 'home-admin' or $matchedRoute == 'home-admin-intern')) {
                return $controller->redirect()->toRoute('bookstore-admin-auth');
            }
        }, 99);

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
                'Bookstore\Auth\Adapter' => function($service) {
                    return new AuthAdapter($service->get('Doctrine\ORM\EntityManager'));
                },
            ]
        ];
    }

    public function getViewHelperConfig()
    {
        return [
            'invokables' => [
                'UserIdentity' => new View\Helper\UserIdentity
            ]
        ];
    }
}
