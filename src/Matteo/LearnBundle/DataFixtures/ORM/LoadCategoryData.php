<?php

namespace Matteo\LearnBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Matteo\LearnBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $em)
    {
        $basics = new Category();
        $basics->setName('Basics');
        $basics->setOverview('For a solid ground.');
        $basics->setDescription('This Category contains cardboxes for fundamental knowledge. This foundation will help you to explore all the other categories on this site.');
        
        
        $nature = new Category();
        $nature->setName('Nature');
        $nature->setOverview('Breath lightly');
        $nature->setDescription('You will get one with the Nature after checking out these cardboxes.');

        $em->persist($basics);
        $em->persist($nature);
        
        $em->flush();
        
        $this->addReference('category-basics', $basics);
        $this->addReference('category-nature', $nature);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}