<?php

namespace Bookstore\Auth;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;

use Bookstore\Entity\User;

use Doctrine\ORM\EntityManager;

class Adapter implements AdapterInterface
{

    private $em;

    private $username;

    private $password;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
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
        $this->password = $password;
        return $this;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {
        $repository = $this->em->getRepository('Bookstore\Entity\User');

        $user = $repository->findByEmailAndPassword($this->getUsername(), $this->getPassword());

        if ($user) {
            return new Result(Result::SUCCESS, ['user' => $user], ['Logado com sucesso!!!']);
        }
        return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, []);
    }
}