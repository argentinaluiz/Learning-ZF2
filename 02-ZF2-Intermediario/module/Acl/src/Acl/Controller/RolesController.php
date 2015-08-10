<?php

namespace Acl\Controller;

use Base\Controller\CrudController;

class RolesController extends CrudController
{
    public function __construct()
    {
        $this->service = 'Acl\Service\Role';
    }
}