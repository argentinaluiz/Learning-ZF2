<?php

namespace BookstoreAdmin\Controller;

use Doctrine\ORM\EntityManager;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

use BookstoreAdmin\Form\Category as FormCategory;

class CategoriesController extends AbstractActionController
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * Categories list
     *
     * @return ViewModel
     */
    public function IndexAction()
    {
        $listCategory = $this->getEm()
            ->getRepository('Bookstore\Entity\Category')
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
        $form = new FormCategory();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get('Bookstore\Service\Category');
                $service->insert($request->getPost()->toArray());

                return $this->redirect()->toRoute('home-admin', ['controller' => 'categories']);
            }
        }

        return new ViewModel(['form' => $form]);
    }

    public function EditAction()
    {
        $form = new FormCategory();
        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository('Bookstore\Entity\Category');
        $entity = $repository->find($this->params()->fromRoute('id', 0));

        if ($this->params()->fromRoute('id', 0))
            $form->setData($entity->toArray());

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get('Bookstore\Service\Category');
                $service->update($request->getPost()->toArray());

                return $this->redirect()->toRoute('home-admin', ['controller' => 'categories']);
            }
        }

        return new ViewModel(['form' => $form]);
    }

    public function deleteAction()
    {
        $service = $this->getServiceLocator()->get('Bookstore\Service\Category');

        if ($service->delete($this->params()->fromRoute('id', 0)))
            return $this->redirect()->toRoute('home-admin', ['controller' => 'categories']);
    }

    /**
     * @return EntityManager
     */
    private function getEm()
    {
        if (null === $this->em)
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        return $this->em;
    }
}