<?php

namespace Bookstore\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $categoryService = $this->getServiceLocator()->get('Bookstore\Services\CategoryService');
        $category = $categoryService->fetchAll();
        return new ViewModel(['category' => $category]);
    }
}
