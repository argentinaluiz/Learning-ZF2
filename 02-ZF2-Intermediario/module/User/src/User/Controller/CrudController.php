<?php

namespace User\Controller;

use Doctrine\ORM\EntityManager;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

/**
 * Class CrudController
 * @package User\Controller
 */
abstract class CrudController extends AbstractActionController
{
    /**
     * @var EntityManager
     */
    protected $em;
    protected $service;
    protected $entity;
    protected $form;
    protected $route;
    protected $controller;

    /**
     * list
     *
     * @return ViewModel
     */
    public function IndexAction()
    {
        $list = $this->getEm()
            ->getRepository($this->entity)
            ->findAll();

        $page = $this->params()->fromRoute('page');
        $pagination = new Paginator(new ArrayAdapter($list));
        $pagination->setCurrentPageNumber($page);
        $pagination->setDefaultItemCountPerPage(10);

        return new ViewModel(['data' => $pagination, 'page' => $page]);
    }

    /**
     * Insert
     *
     * @return \Zend\Http\Response|ViewModel
     */
    public function newAction()
    {
        $form = new $this->form();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get($this->service);

                if($service->insert($request->getPost()->toArray())) {
                    $this->flashMessenger()->addSuccessMessage('Usuário cadastrado com sucesso! Eviamos uma ativação para seu email!!!');
                } else {
                    $this->flashMessenger()->addErrorMessage('Erro ao fazer o cadastro!!!');
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
        $form = new $this->form();
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

    /**
     * Delete
     *
     * @return \Zend\Http\Response
     */
    public function deleteAction()
    {
        $service = $this->getServiceLocator()->get($this->service);

        if ($service->delete($this->params()->fromRoute('id', 0)))
            return $this->redirect()->toRoute($this->route, ['controller' => $this->controller]);
    }

    /**
     * @return EntityManager
     */
    protected function getEm()
    {
        if (null === $this->em)
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        return $this->em;
    }
}