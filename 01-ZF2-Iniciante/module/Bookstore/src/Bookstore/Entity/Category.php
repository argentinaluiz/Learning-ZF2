<?php

namespace Bookstore\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Category
 * @package Bookstore\Entity
 */
class Category
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Array
     */
    private $books;

    /**
     * Construct
     *
     * @param null $options
     * @throws \Exception
     */
    public function __construct($options = null)
    {
        Configurator::configure($this, $options);
        $this->books = new ArrayCollection();
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
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName()
        ];
    }
}
