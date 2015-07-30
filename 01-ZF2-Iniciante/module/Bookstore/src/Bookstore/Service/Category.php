<?php

namespace Bookstore\Service;

use Doctrine\ORM\EntityManager;
use Bookstore\Entity\Category as CategoryEntity;

class Category
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * Category constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert(Array $data)
    {
        $entity = new CategoryEntity($data);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }


}