<?php

namespace Acl\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use Acl\Entity\Role;

class LoadRole extends AbstractFixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $role = new Role();
        $role->setName('Visitante');
        $manager->persist($role);

        $visitante = $manager->getReference('Acl\Entity\Role', 1);

        $role = new Role();
        $role->setName('Registrado')
            ->setParent($visitante);
        $manager->persist($role);

        $registrado = $manager->getReference('Acl\Entity\Role', 2);

        $role = new Role();
        $role->setName('Redator')
            ->setParent($registrado);
        $manager->persist($role);

        $role = new Role();
        $role->setName('Admin')
            ->setIsAdmin(true);
        $manager->persist($role);
        
        $manager->flush();
    }
}