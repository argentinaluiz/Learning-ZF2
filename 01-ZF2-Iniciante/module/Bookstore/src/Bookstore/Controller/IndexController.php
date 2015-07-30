<?php

namespace Bookstore\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $categories = $em->getRepository('Bookstore\Entity\Category')->findAll();

        return new ViewModel(['categories' => $categories]);
    }
}
