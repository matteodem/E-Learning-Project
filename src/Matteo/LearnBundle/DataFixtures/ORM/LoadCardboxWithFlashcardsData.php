<?php

namespace Matteo\LearnBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Matteo\LearnBundle\Entity\Cardbox;
use Matteo\LearnBundle\Entity\Flashcard;

class LoadCardboxWithFlashcardsData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $em)
    {
        $getstarted = new Cardbox();
        $getstarted->setName('Get started');
        $getstarted->setDescription('Used on the get started section of this site');
        $getstarted->setDifficulty(1);
        $getstarted->setFrontSide('English');
        $getstarted->setBackSide('German');
        $getstarted->setCategory($this->getReference('category-basics'));
        
        $human = new Flashcard();
        $human->setFront('human (noun)');
        $human->setBack('der Mensch (Nomen)');
        $human->setDeclaration('Humans (Homo sapiens) are primates of the family Hominidae, and the only living species of the genus Homo. More Infos here: http://en.wikipedia.org/wiki/Human');
        $human->setCardbox($getstarted);
        
        $dog = new Flashcard();
        $dog->setFront('dog (noun)');
        $dog->setBack('der Hund (Nomen)');
        $dog->setDeclaration('The domestic dog (Canis lupus familiaris), is a subspecies of the gray wolf (Canis lupus), a member of the Canidae family of the mammalian order Carnivora. More Infos here: http://en.wikipedia.org/wiki/Dog');
        $dog->setCardbox($getstarted);
        
        // TODO: Flashcards need to be added
        $em->persist($getstarted);
        $em->persist($human);
        $em->persist($dog);
        
        $em->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}