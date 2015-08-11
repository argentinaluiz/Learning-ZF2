<?php

namespace CJSN\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $cache = $this->getServiceLocator()->get('Cache');

        if (!$result = $cache->getItem('dateCache')) {
            $result = new \DateTime('now');
            $cache->addItem('dateCache', $result);
        }



        echo $result->format('d/m/Y - H:i:s');
        die;
        return new ViewModel();
    }
}
