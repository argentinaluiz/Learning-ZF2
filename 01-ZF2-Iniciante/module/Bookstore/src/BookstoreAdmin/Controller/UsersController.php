<?php

namespace BookstoreAdmin\Controller;
use Zend\View\Model\ViewModel;

/**
 * Class UsersController
 * @package BookstoreAdmin\Controller
 */
class UsersController extends CRUDController
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->entity       = 'Bookstore\Entity\User';
        $this->service      = 'Bookstore\Service\User';
        $this->form         = 'BookstoreAdmin\Form\User';
        $this->controller   = 'users';
        $this->route        = 'bookstore-admin';
    }

    /**
     * Edit User
     *
     * @return ViewModel|\Zend\Http\Response
     */
    public function editAction() {
        $form = new $this->form();
        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id', 0));

        if ($this->params()->fromRoute('id', 0)) {
            $array = $entity->toArray();
            unset($array['password']);
            $form->setData($array);
        }
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);

                $service->update($request->getPost()->toArray());
                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
            }
        }
        return new ViewModel(array('form' => $form));
    }
}