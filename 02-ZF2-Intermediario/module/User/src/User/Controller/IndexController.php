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
                    $ms = $this->flashMessenger()
                        ->setNamespace('User')
                        ->addMessage("Usuário cadastrado com sucesso!!!");
                }

                return $this->redirect()->toRoute('user-register');
            }
        }

        $messages = $this->flashMessenger()
            ->setNamespace('User')
            ->getMessages();

        return new ViewModel(array('form'=>$form,'messages'=>$messages));
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