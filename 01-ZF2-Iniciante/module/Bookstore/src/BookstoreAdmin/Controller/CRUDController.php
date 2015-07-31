<?php

namespace BookstoreAdmin\Controller;

use Doctrine\ORM\EntityManager;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

/**
 * Class CRUDController
 * @package BookstoreAdmin\Controller
 */
abstract class CRUDController extends AbstractActionController
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
     * Categories list
     *
     * @return ViewModel
     */
    public function IndexAction()
    {
        $listCategory = $this->getEm()
            ->getRepository($this->entity)
            ->findAll();

        $page = $this->params()->fromRoute('page');
        $pagination = new Paginator(new ArrayAdapter($listCategory));
        $pagination->setCurrentPageNumber($page);
        $pagination->setDefaultItemCountPerPage(10);

        return new ViewModel(['data' => $pagination, 'page' => $page]);
    }

    /**
     * Insert new category
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
                $service->insert($request->getPost()->toArray());

                return $this->redirect()->toRoute($this->route, ['controller' => $this->controller]);
            }
        }

        return new ViewModel(['form' => $form]);
    }

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

    public function deleteAction()
    {
        $service = $this->getServiceLocator()->get($this->service);

        if ($service->delete($this->params()->fromRoute('id', 0)))
            return $this->redirect()->toRoute($this->route, ['controller' => $this->controller]);
    }

    /**
     * @return EntityManager
     */
    public function getEm()
    {
        if (null === $this->em)
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        return $this->em;
    }
}