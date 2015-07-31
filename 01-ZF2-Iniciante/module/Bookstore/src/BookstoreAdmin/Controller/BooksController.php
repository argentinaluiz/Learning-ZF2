<?php

namespace BookstoreAdmin\Controller;
use Zend\View\Model\ViewModel;

/**
 * Class BooksController
 * @package BookstoreAdmin\Controller
 */
class BooksController extends CRUDController
{
    public function __construct()
    {
        $this->entity = 'Bookstore\Entity\Book';
        $this->form = 'BookstoreAdmin\Form\Book';
        $this->service = 'Bookstore\Service\Book';
        $this->controller = 'books';
        $this->route = 'home-admin';
    }

    /**
     * Insert Book
     *
     * @return \Zend\Http\Response|ViewModel
     */
    public function newAction()
    {
        $form = $this->getServiceLocator()->get($this->form);
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

    /**
     * Edit Book
     *
     * @return \Zend\Http\Response|ViewModel
     */
    public function EditAction()
    {
        $form = $this->getServiceLocator()->get($this->form);
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

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }

        return new ViewModel(array('form' => $form));
    }
}