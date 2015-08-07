<?php

namespace Acl\Entity;

use Zend\Stdlib\Hydrator;

/**
 * Class Resource
 * @package Acl\Entity
 */
class Resource extends Timestampable
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
     * To Array
     *
     * @return array
     */
    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }
}