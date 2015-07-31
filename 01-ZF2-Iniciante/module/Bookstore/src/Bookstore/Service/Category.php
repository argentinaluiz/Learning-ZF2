<?php

namespace Bookstore\Service;

use Doctrine\ORM\EntityManager;

/**
 * Class Category
 * @package Bookstore\Service
 */
class Category extends AbstractService
{
    /**
     * Construct
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);

        $this->entity = 'Bookstore\Entity\Category';
    }
}
