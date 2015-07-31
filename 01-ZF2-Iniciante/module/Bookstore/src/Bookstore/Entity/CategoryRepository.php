<?php

namespace Bookstore\Entity;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function fetchPairs()
    {
        $entities = $this->findAll();

        $array = [];

        foreach($entities as $entity) {
            $array[$entity->getId()] = $entity->getName();
        }

        return $array;
    }
}