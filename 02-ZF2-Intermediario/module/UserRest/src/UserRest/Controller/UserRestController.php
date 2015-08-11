<?php

namespace UserRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

use Zend\View\Model\JsonModel;

class UserRestController extends AbstractRestfulController
{

    public function getList()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $repository = $em->getRepository('User\Entity\User');

        $data = $repository->findArray();

        return new JsonModel(['data' => $data]);
    }

    public function get($id)
    {

    }

    public function create($data)
    {

    }

    public function update($id, $data)
    {

    }

    public function delete($id)
    {

    }
}