<?php

namespace Acl\Entity;

use Zend\Stdlib\Hydrator;

/**
 * Class Role
 * @package Acl\Entity
 */
class Role extends Timestampable
{
    /**
     * @var Integer
     */
    protected $id;

    /**
     * @var String
     */
    protected $name;

    /**
     * @var Boolean
     */
    protected $isAdmin;

    protected $parent;

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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
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
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set IsAdmin
     *
     * @param $isAdmin
     * @return $this
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set Parent
     *
     * @param $parent
     * @return $this
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * To Array
     *
     * @return array
     */
    public function toArray()
    {
        if (isset($this->parent))
            $parent = $this->parent->getId();
        else
            $parent = false;

        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'isAdmin' => $this->getIsAdmin(),
            'parent' => $parent
        ];
    }

    /**
     * Magic To String
     *
     * @return String
     */
    public function __toString()
    {
        return $this->name;
    }
}