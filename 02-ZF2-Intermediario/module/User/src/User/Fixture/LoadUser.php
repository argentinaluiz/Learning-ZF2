<?php

namespace User\Fiixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use User\Entity\User;

class LoadUser extends AbstractFixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName('Candido')
            ->setEmail('candido@email.com')
            ->setPassword(123456)
            ->setActive(true);
        $manager->persist($user);
        $manager->flush();
    }
}