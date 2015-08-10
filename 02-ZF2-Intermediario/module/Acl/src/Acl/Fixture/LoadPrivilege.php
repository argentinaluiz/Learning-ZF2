<?php

namespace Acl\Fixture;

use Acl\Entity\Privilege;
use Acl\Entity\Provilege;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class LoadPrivilege extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $role1 = $manager->getReference('Acl\Entity\Role', 1);
        $resource1 = $manager->getReference('Acl\Entity\Resource',1);

        $role2 = $manager->getReference('Acl\Entity\Role', 2);
        $resource2 = $manager->getReference('Acl\Entity\Resource',2);

        $role3 = $manager->getReference('Acl\Entity\Role', 3);
        $resource3 = $manager->getReference('Acl\Entity\Resource',3);

        $role4 = $manager->getReference('Acl\Entity\Role', 4);
        $resource4 = $manager->getReference('Acl\Entity\Resource',4);

        $privilege = new Privilege();
        $privilege->setName("Visualizar")
            ->setRole($role1)
            ->setResource($resource1);
        $manager->persist($privilege);

        $privilege = new Privilege();
        $privilege->setName("Novo / Editar")
            ->setRole($role3)
            ->setResource($resource1);
        $manager->persist($privilege);

        $privilege = new Privilege();
        $privilege->setName("Excluir")
            ->setRole($role4)
            ->setResource($resource1);
        $manager->persist($privilege);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 3;
    }
}