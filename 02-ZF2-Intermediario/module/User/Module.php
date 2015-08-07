<?php

namespace User;

use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

use User\Service\User as UserService;
use User\Auth\Adapter as AuthAdapter;

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

    public function init(ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();

        $sharedEvents->attach('Zend\Mvc\Controller\AbstractActionController', MvcEvent::EVENT_DISPATCH, [$this, 'validAuth'], 100);
    }

    public function validAuth($e)
    {
        $auth = new AuthenticationService();
        $auth->setStorage(new SessionStorage("User"));

        $controller = $e->getTarget();
        $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();

        if (!$auth->hasIdentity() && ($matchedRoute == 'user-admin' || $matchedRoute == 'user-admin/paginator')) {
            return $controller->redirect()->toRoute('user-auth');
        }
    }

    public function getServiceConfig()
    {
        return [
            'factories' => array(
                'User\Mail\Transport' => function($sm) {
                    $config = $sm->get('Config');

                    $transport = new SmtpTransport;
                    $options = new SmtpOptions($config['mail']);
                    $transport->setOptions($options);

                    return $transport;
                },
                'User\Service\User' => function($sm) {
                    return new UserService($sm->get('Doctrine\ORM\EntityManager'),
                        $sm->get('User\Mail\Transport'),
                        $sm->get('View'));
                },
                'User\Auth\Adapter' => function($sm) {
                    return new AuthAdapter($sm->get('Doctrine\ORM\EntityManager'));
                }
            )
        ];
    }

    public function getViewHelperConfig()
    {
        return [
            'invokables' => [
                'UserIdentity' => new View\Helper\UserIdentity()
            ]
        ];
    }
}
