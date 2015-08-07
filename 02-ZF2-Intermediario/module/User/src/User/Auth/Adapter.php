<?php

namespace User\Auth;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;

use Doctrine\ORM\EntityManager;

class Adapter implements AdapterInterface
{

    protected $em;

    protected $username;

    protected $password;

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
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {
        $repository = $this->em->getRepository('User\Entity\User');

        $user = $repository->findOneByEmailAndPassword($this->getUsername(), $this->getPassword());

        if ($user)
            return new Result(Result::SUCCESS, ['user' => $user], ['success']);
        return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, ['error']);
    }
}