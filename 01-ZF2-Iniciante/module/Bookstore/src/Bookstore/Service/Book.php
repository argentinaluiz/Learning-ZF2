<?php

namespace Bookstore\Service;

use Doctrine\ORM\EntityManager;

use Bookstore\Entity\Configurator;

/**
 * Class Book
 * @package Bookstore\Service
 */
class Book extends AbstractService
{
    /**
     * Construct
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);

        $this->entity = 'Bookstore\Entity\Book';
    }

    /**
     * Insert Book
     *
     * @param array $data
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     */
    public function insert(Array $data)
    {
        $entity = new $this->entity($data);

        $category = $this->em->getReference('Bookstore\Entity\Category', $data['categories']);
        $entity->setCategory($category);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    public function update(Array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);
        $entity = Configurator::configure($entity, $data);

        $category = $this->em->getReference('Bookstore\Entity\Category', $data['categories']);
        $entity->setCategory($category);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }
}
