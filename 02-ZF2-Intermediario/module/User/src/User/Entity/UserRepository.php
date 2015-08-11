<?php

namespace User\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findOneByEmailAndPassword($email, $password)
    {
        $user = $this->findOneByEmail($email);

        if ($user) {
            $hashPassword = $user->encryptPassword($password);

            if ($hashPassword == $user->getPassword())
                return $user;
            return false;
        }

        return false;
    }

    public function findArray()
    {
        $users = $this->findAll();

        $array = [];

        foreach ($users as $user) {
            $array[$user->getId()]['id'] = $user->getId();
            $array[$user->getName()]['name'] = $user->getName();
            $array[$user->getEmail()]['email'] = $user->getEmail();
        }

        return $array;
    }
}