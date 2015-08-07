<?php

namespace Acl\Entity;

use Zend\Stdlib\Hydrator;

class Role
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

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;


    protected $parent;

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
     * @return mixed
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