<?php

namespace Acl\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

class Privilege extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->entity = 'Acl\Entity\Privilege';
    }

    /**
     * Insert
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        $entity = new $this->entity($data);

        $role =  $this->em->getReference('Acl\Entity\Role', $data['role']);
        $resource =  $this->em->getReference('Acl\Entity\Resource', $data['resource']);

        $entity->setRole($role);
        $entity->setResource($resource);

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    /**
     * Update
     *
     * @param array $data
     * @return bool|\Doctrine\Common\Proxy\Proxy|null|object
     */
    public function update(array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $entity);

        $role =  $this->em->getReference('Acl\Entity\Role', $data['role']);
        $resource =  $this->em->getReference('Acl\Entity\Resource', $data['resource']);

        $entity->setRole($role);
        $entity->setResource($resource);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }
}