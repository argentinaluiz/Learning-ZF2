<?php

namespace Bookstore\Service;

use Doctrine\ORM\EntityManager;

use Bookstore\Entity\Configurator;

/**
 * Class AbstractService
 * @package Bookstore\Service
 */
abstract class AbstractService
{
    /**
     * @var EntityManager
     */
    private $em;

    protected $entity;

    /**
     * Category constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Insert Category
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
     * Update Category
     *
     * @param array $data
     * @return bool|\Doctrine\Common\Proxy\Proxy|null|object|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Exception
     */
    public function update(Array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);

        $entity = Configurator::configure($entity, $data);
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * Delete Category
     *
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
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