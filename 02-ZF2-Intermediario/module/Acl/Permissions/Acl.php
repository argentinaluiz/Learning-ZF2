<?php

namespace Acl\Permissions;

use Zend\Permissions\Acl\Acl as ClassAcl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

/**
 * Class Acl
 * @package Acl\Permissions
 */
class Acl extends ClassAcl
{
    /**
     * @var array
     */
    protected $roles;

    /**
     * @var array
     */
    protected $resources;

    /**
     * @var array
     */
    protected $privileges;

    /**
     * Construct
     *
     * @param array $roles
     * @param array $resources
     * @param array $privileges
     */
    public function __construct(array $roles, array $resources, array $privileges)
    {
        $this->roles = $roles;
        $this->resources = $resources;
        $this->privileges = $privileges;

        $this->loadRoles();
        $this->loadResources();
        $this->loadPrivileges();
    }

    /**
     * Load Roles
     */
    protected function loadRoles()
    {
        foreach($this->roles as $role) {
            if ($role->getParent())
                $this->addRole(new Role($role->getName(), new Role($role->getParent()->getName())));
            $this->addRole(new Role($role->getName()));

            if ($role->getIsAdmin())
                $this->allow($role->getName(), null, null);
        }
    }

    /**
     * Load Resources
     */
    protected function loadResources()
    {
        foreach($this->resources as $resource) {
            $this->addResource(new Resource($resource));
        }
    }

    /**
     * Load Privileges
     */
    protected function loadPrivileges()
    {
        foreach($this->privileges as $privilege) {
            $this->allow($privilege->getRole()->getName(), $privilege->getReourse()->getName(), $privilege->getName());
        }
    }
}
