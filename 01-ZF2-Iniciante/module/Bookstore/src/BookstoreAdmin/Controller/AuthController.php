<?php

namespace BookstoreAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

use BookstoreAdmin\Form\Login as FormLogin;

class AuthController extends AbstractActionController
{
    public function indexAction()
    {
        $form = new FormLogin();
        $error = false;
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $request->getPost()->toArray();

                $auth = new AuthenticationService();

                $sessionStorage = new SessionStorage('BookstoreAdmin');
                $auth->setStorage($sessionStorage);

                $authAdapter = $this->getServiceLocator()->get('Bookstore\Auth\Adapter');
                $authAdapter->setUsername($data['email'])
                    ->setPassword($data['password']);

                $result= $auth->authenticate($authAdapter);

                if ($result->isValid()) {
                    $sessionStorage->write($auth->getIdentity(), ['user'], null);
                    return $this->redirect()->toRoute('bookstore-admin', ['controller' => 'categories']);
                } else
                    $error = true;
            }
        }

        return new ViewModel(['form' => $form, 'error' => $error]);
    }

    public function logoutAction() {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage('BookstoreAdmin'));
        $auth->clearIdentity();

        return $this->redirect()->toRoute('bookstore-admin-auth');
    }
}