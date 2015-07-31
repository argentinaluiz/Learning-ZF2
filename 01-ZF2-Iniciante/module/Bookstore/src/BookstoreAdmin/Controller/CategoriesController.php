<?php

namespace BookstoreAdmin\Controller;

/**
 * Class CategoriesController
 * @package BookstoreAdmin\Controller
 */
class CategoriesController extends CRUDController
{
    public function __construct()
    {
        $this->entity = 'Bookstore\Entity\Category';
        $this->form = 'BookstoreAdmin\Form\Category';
        $this->service = 'Bookstore\Service\Category';
        $this->controller = 'categories';
        $this->route = 'home-admin';
    }
}