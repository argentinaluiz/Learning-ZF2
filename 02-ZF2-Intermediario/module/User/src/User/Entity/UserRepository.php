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
}