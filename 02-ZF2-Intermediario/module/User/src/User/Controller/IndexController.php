<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use User\Form\User as FormUser;

/**
 * Class IndexController
 * @package User\Controller
 */
class IndexController extends AbstractActionController
{
    /**
     * Create new user
     *
     * @return \Zend\Http\Response|ViewModel
     */
    public function registerAction()
    {
        $form = new FormUser;
        $request = $this->getRequest();

        if($request->isPost()) {
            $form->setData($request->getPost());
            if($form->isValid()) {
                $service = $this->getServiceLocator()->get('User\Service\User');

                if($service->insert($request->getPost()->toArray())) {
                    $this->flashMessenger()->addSuccessMessage('Usuário cadastrado com sucesso! Eviamos uma ativação para seu email!!!');
                } else {
                    $this->flashMessenger()->addErrorMessage('Erro ao fazer o cadastro!!!');
                }

                return $this->redirect()->toRoute('user-register', ['controller' => 'User\Controller\Index', ]);
            }
        }

        if ($this->flashMessenger()->hasSuccessMessages()) {
            return new ViewModel(['form' => $form, 'success' => $this->flashMessenger()->getSuccessMessages()]);
        }

        if ($this->flashMessenger()->hasErrorMessages()) {
            return new ViewModel(['form' => $form, 'error' => $this->flashMessenger()->getErrorMessages()]);
        }


        return new ViewModel(['form'=>$form]);
    }

    public function activateAction()
    {
        $activationkey = $this->params()->fromRoute('key');

        $userService = $this->getServiceLocator()->get('User\Service\User');

        $result = $userService->activate($activationkey);

        if ($result)
            return new ViewModel(['user' => $result]);
        return new ViewModel();
    }
}