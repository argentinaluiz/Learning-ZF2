<?php

namespace Acl\Entity;

/**
 * Class Timestampable
 * @package Acl\Entity
 */
abstract class Timestampable
{
    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->updatedAt = new \DateTime('now');
        $this->createdAt = new \DateTime('now');
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
}