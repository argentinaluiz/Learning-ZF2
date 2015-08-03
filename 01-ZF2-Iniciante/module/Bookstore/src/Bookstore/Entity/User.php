<?php

namespace Bookstore\Entity;

/**
 * Class User
 * @package Bookstore\Entity
 */
class User
{
    /**
     * @var Int
     */
    private $id;

    /**
     * @var String
     */
    private $name;

    /**
     * @var String
     */
    private $email;

    /**
     * @var String
     */
    private $password;

    /**
     * @var String
     */
    private $salt;


    public function __construct($options = null)
    {
        Configurator::configure($this, $options);

        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
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
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return $this
     */
    public function setPassword($password)
    {
        $hashPassword = $this->encryptPassword($password);

        $this->password = $hashPassword;

        return $this;
    }

    /**
     * @return String
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param $password
     * @return string
     */
    public function encryptPassword($password)
    {
        $hashPassword = hash('sha512', $password.$this->salt);

        for($i = 0; $i < 64000; $i ++)
            $hashPassword = hash('sha512', $hashPassword);

        return $hashPassword;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword()
        ];
    }
}
