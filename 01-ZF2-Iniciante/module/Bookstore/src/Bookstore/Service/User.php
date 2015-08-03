<?php

namespace Bookstore\Service;

use Bookstore\Entity\Configurator;
use Doctrine\ORM\EntityManager;

/**
 * Class User
 * @package Bookstore\Service
 */
class User extends AbstractService
{
    /**
     * Construct
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);

        $this->entity = 'Bookstore\Entity\User';
    }

    public function update(array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);

        if (empty($data['password']))
            unset($data['password']);

        $entity = Configurator::configure($entity, $data);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }
}
