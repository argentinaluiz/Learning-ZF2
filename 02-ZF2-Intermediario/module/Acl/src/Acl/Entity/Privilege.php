<?php

namespace Acl\Entity;

use Zend\Stdlib\Hydrator;

/**
 * Class Privilege
 * @package User\Entity
 */
class Privilege extends Timestampable
{
    /**
     * @var Integer
     */
    protected $id;

    /**
     * @var String
     */
    protected $name;

    protected $role;

    protected $resource;

    /**
     * Construct
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct();
        (new Hydrator\ClassMethods())->hydrate($options, $this);
    }

    /**
     * Get Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Name
     *
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Name
     *
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get Role
     *
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set Role
     *
     * @param $role
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Get Resource
     *
     * @return mixed
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set Resource
     *
     * @param $resource
     * @return $this
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
        return $this;
    }

    /**
     * To Array
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'role' => $this->getRole()->getId(),
            'resource' => $this->getResource()->getId()
        ];
    }
}