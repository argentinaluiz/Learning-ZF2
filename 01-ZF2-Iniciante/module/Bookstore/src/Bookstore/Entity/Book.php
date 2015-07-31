<?php

namespace Bookstore\Entity;

class Book
{
    /**
     * @var Int
     */
    private $id;

    /**
     * @var String
     */
    private $name;

    private $category;

    /**
     * @var String
     */
    private $author;

    /**
     * @var String
     */
    private $isbn;

    /**
     * @var Float
     */
    private $price;

    public function __construct($options = null)
    {
        Configurator::configure($this, $options);
    }

    /**
     * @return Int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return String
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
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param $category
     * @return $this
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return String
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param $author
     * @return $this
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return String
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param $isbn
     * @return $this
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
        return $this;
    }

    /**
     * @return Float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'author' => $this->getAuthor(),
            'isbn' => $this->getIsbn(),
            'price' => $this->getPrice(),
            'category' => $this->getCategory(),
        ];
    }
}