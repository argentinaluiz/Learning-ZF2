<?php

namespace Bookstore\Service;

use Doctrine\ORM\EntityManager;

class Category extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);

        $this->entity = 'Bookstore\Entity\Category';
    }
}
