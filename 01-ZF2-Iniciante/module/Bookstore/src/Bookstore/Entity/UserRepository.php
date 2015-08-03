<?php

namespace Bookstore\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findByEmailAndPassword($email, $password)
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