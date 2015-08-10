<?php

namespace Acl\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Acl\Entity\Role;

class LoadRole extends AbstractFixture implements OrderedFixtureInterface
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

    /*
     * Bypass Doctrine Candido
     *
     * Caminho do arquivo para alteraçao
     * vendor/doctrine/data-fixtures/lib/Doctrine/Common/DataFixtures/Purger/PRMPurger.php
     *
     * Aproximadamente linha 136
     *
     * $this->em->getConnection()->executeUpdate("SET foreign_key_checks = 0;");
     * $this->em->getConnection()->executeUpdate($platform->getTruncateTableSQL($tbl, true));
     * $this->em->getConnection()->executeUpdate("SET foreign_key_checks = 1;");
     */
    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 1;
    }
}