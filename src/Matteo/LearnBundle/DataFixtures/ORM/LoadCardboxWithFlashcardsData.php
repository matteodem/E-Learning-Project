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
        /* Get started Cardbox */
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
        
        
        $walk = new Flashcard();
        $walk->setFront('walk (verb)');
        $walk->setBack('laufen (verb)');
        $walk->setDeclaration('A verb, from the Latin verbum meaning word, is a word (part of speech) that in syntax conveys an action (bring, read, walk, run, learn), an occurrence (happen, become), or a state of being (be, exist, stand). In the usual description of English, the basic form, with or without the particle to, is the infinitive. More Infos here: http://en.wikipedia.org/wiki/Verb');
        $walk->setCardbox($getstarted);
        
        /* Cardbox with a lot of entries */
        $bigCardbox = new Cardbox();
        $bigCardbox->setName('This is big');
        $bigCardbox->setDescription('Used to test big cardboxes');
        $bigCardbox->setDifficulty(1);
        $bigCardbox->setFrontSide('Test');
        $bigCardbox->setBackSide('Another Test');
        $bigCardbox->setCategory($this->getReference('category-basics'));
        
        
        for ($i = 0; $i < 150; $i++) {
            $card = new Flashcard();
            $card->setFront('test' . $i);
            $card->setBack('test2' . $i);
            $card->setDeclaration('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.' . $i);
            $card->setCardbox($bigCardbox);
            
            $em->persist($card);
        }

        $em->persist($bigCardbox);
        $em->persist($getstarted);
        $em->persist($human);
        $em->persist($dog);
        $em->persist($walk);
        
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