<?php

namespace Acl\Fixture;

use Acl\Entity\Resource;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class LoadResouce extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $resource = new Resource();
        $resource->setName("Posts");
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setName("Páginas");
        $manager->persist($resource);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 2;
    }
}