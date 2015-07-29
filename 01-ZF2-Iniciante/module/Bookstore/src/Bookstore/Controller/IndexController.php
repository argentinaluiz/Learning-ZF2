<?php

namespace Bookstore\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $name = "Candido Souza";
        return new ViewModel(['name' => $name]);
    }
}
