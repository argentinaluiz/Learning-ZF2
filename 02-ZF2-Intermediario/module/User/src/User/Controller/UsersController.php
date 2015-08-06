<?php

namespace User\Controller;


class UsersController extends CrudController
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->entity       = 'User\Entity\User';
        $this->service      = 'User\Service\User';
        $this->form         = 'User\Form\User';
        $this->controller   = 'users';
        $this->route        = 'user-admin';
    }
}