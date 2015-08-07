<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

use User\Form\Login as FormLogin;

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

                $sessionStorage = new SessionStorage('User');
                $auth->setStorage($sessionStorage);

                $authAdapter = $this->getServiceLocator()->get('User\Auth\Adapter');
                $authAdapter->setUsername($data['email']);
                $authAdapter->setPassword($data['password']);

                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {
                    $sessionStorage->write($auth->getIdentity()['user'], null);
                    return $this->redirect()->toRoute('user-admin/default', ['controller' => 'users']);
                } else
                    $error = true;
            }
        }

        return new ViewModel(['form' => $form, 'error' => $error]);
    }

    /**
     * Logout user
     *
     * @return \Zend\Http\Response
     */
    public function logoutAction() {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage('User'));
        $auth->clearIdentity();

        return $this->redirect()->toRoute('user-auth');
    }
}