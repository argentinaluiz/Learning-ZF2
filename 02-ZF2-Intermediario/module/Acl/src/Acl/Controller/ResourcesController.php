<?php

namespace Acl\Controller;

use Base\Controller\CrudController;

/**
 * Class ResourcesController
 * @package Acl\Controller
 */
class ResourcesController extends CrudController
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->entity = 'Acl\Entity\Resource';
        $this->service = 'Acl\Service\Resource';
        $this->form = 'Acl\Form\Resource';
        $this->controller = 'resources';
        $this->route = 'acl-admin/default';
    }
}
