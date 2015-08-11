<?php

namespace Acl\Controller;

use Base\Controller\CrudController;
use Zend\View\Model\ViewModel;

/**
 * Class RolesController
 * @package Acl\Controller
 */
class RolesController extends CrudController
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->entity = 'Acl\Entity\Role';
        $this->service = 'Acl\Service\Role';
        $this->form = 'Acl\Form\Role';
        $this->controller = 'roles';
        $this->route = 'acl-admin/default';
    }

    /**
     * Insert
     *
     * @return \Zend\Http\Response|ViewModel
     */
    public function newAction()
    {
        $form = $this->getServiceLocator()->get('Acl\Form\Role');
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get($this->service);

                if($service->insert($request->getPost()->toArray())) {
                    $this->flashMessenger()->addSuccessMessage('Cadastrado com sucesso!!!');
                } else {
                    $this->flashMessenger()->addErrorMessage('Erro ao cadastro!!!');
                }

                return $this->redirect()->toRoute($this->route, ['controller' => $this->controller]);
            }
        }

        if ($this->flashMessenger()->hasSuccessMessages()) {
            return new ViewModel(['form' => $form, 'success' => $this->flashMessenger()->getSuccessMessages()]);
        }

        if ($this->flashMessenger()->hasErrorMessages()) {
            return new ViewModel(['form' => $form, 'error' => $this->flashMessenger()->getErrorMessages()]);
        }

        return new ViewModel(['form' => $form]);
    }

    /**
     * Edit
     *
     * @return \Zend\Http\Response|ViewModel
     */
    public function EditAction()
    {
        $form = $this->getServiceLocator()->get('Acl\Form\Role');
        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id', 0));

        if ($this->params()->fromRoute('id', 0))
            $form->setData($entity->toArray());

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());

                return $this->redirect()->toRoute($this->route, ['controller' => $this->controller]);
            }
        }

        return new ViewModel(['form' => $form]);
    }

    public function testeAction()
    {
        $acl = $this->getServiceLocator()->get('Acl\Permissions\Acl');

        echo $acl->isAllowed("Admin", "Posts", "Excluir")? "Permitido" : "Negado";
        die;
    }
}