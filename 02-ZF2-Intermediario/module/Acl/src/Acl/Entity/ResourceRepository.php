<?php

namespace Acl\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Class ResourceRepository
 * @package Acl\Entity
 */
class ResourceRepository extends EntityRepository
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