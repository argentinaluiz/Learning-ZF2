<?php

namespace User\Service;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator;

abstract class AbstractService
{
    /**
     * @var EntityManager
     */
    protected $em;

    protected $entity;

    /**
     * AbstractService constructor.
     * @param $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Insert
     *
     * @param array $data
     * @return mixed
     */
    public function insert(Array $data)
    {
        $entity = new $this->entity($data);

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

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * Delete
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $entity = $this->em->getReference($this->entity, $id);

        if ($entity) {
            $this->em->remove($entity);
            $this->em->flush();

            return $id;
        }
    }
}
