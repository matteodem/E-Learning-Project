<?php

namespace Matteo\LearnBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * FlashcardRepository
 */
class FlashcardRepository extends EntityRepository
{
    public function findFlashcardsWithCardbox($id) 
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT p FROM MatteoLearnBundle:Flashcard p WHERE p.cardbox = :id')
                    ->setParameter('id', $id)
                    ->getResult();
    }
}
