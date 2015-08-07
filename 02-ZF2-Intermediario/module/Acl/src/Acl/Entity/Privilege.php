<?php

namespace User\Entity;

use Zend\Stdlib\Hydrator;

/**
 * Class Privilege
 * @package User\Entity
 */
class Privilege
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
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    protected $role;

    protected $resource;

    /**
     * Construct
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);

        $this->updatedAt = new \DateTime('now');
        $this->createdAt = new \DateTime('now');
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
     * Get CreatedAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set CreatedAt
     *
     * @return $this
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime('now');
        return $this;
    }

    /**
     * Get UpdatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set UpdatedAt
     *
     * @return $this
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime('now');
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