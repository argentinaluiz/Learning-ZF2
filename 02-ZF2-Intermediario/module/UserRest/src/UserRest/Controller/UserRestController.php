<?php

namespace UserRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

use Zend\View\Model\JsonModel;

class UserRestController extends AbstractRestfulController
{

    /**
     * List User API Rest
     *
     * @return JsonModel
     */
    public function getList()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repository = $em->getRepository('User\Entity\User');
        $data = $repository->findArray();

        return new JsonModel(['data' => $data]);
    }

    /**
     * List User id API Rest
     *
     * @param mixed $id
     * @return JsonModel
     */
    public function get($id)
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repository = $em->getRepository('User\Entity\User');
        $data = $repository->find($id)->toArray();

        return new JsonModel(['data' => $data]);
    }

    /**
     * Create User API Rest
     *
     * @param mixed $data
     * @return JsonModel
     */
    public function create($data)
    {
        $userService = $this->getServiceLocator()->get('User\Service\User');

        if ($data) {
            $user = $userService->insert($data);
            if ($user)
                return new JsonModel(['data' => ['id' => $user->getId(), 'success' => true]]);
            return new JsonModel(['data' => ['success' => false]]);
        }
        return new JsonModel(['data' => ['success' => false]]);
    }

    /**
     * Update User API Rest
     *
     * @param mixed $id
     * @param mixed $data
     * @return JsonModel
     */
    public function update($id, $data)
    {
        $data['id'] = $id;

        $userService = $this->getServiceLocator()->get('User\Service\User');

        if ($data) {
            $user = $userService->update($data);
            if ($user)
                return new JsonModel(['data' => ['id' => $user->getId(), 'success' => true]]);
            return new JsonModel(['data' => ['success' => false]]);
        }
        return new JsonModel(['data' => ['success' => false]]);
    }

    /**
     * Delete User API Rest
     *
     * @param mixed $id
     * @return JsonModel
     */
    public function delete($id)
    {
        $userService = $this->getServiceLocator()->get('User\Service\User');

        $result = $userService->delete($id);

        if ($result)
            return new JsonModel(['data' => ['success' => true]]);
        return new JsonModel(['data' => ['success' => false]]);
    }
}