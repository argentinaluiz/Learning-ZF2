<?php

namespace BookstoreAdmin\Controller;

use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

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

        return new ViewModel(['data' => $listCategory]);
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