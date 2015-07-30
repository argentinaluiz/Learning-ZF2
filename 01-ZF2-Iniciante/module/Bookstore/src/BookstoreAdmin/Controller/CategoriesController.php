<?php

namespace BookstoreAdmin\Controller;

use Doctrine\ORM\EntityManager;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;


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
        $pagination->setDefaultItemCountPerPage(7);

        return new ViewModel(['data' => $pagination, 'page' => $page]);
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