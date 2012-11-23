<?php

namespace Matteo\LearnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flashcard
 */
class Flashcard
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $front;

    /**
     * @var string
     */
    private $back;

    /**
     * @var string
     */
    private $declaration;

    /**
     * @var \Matteo\LearnBundle\Entity\Cardbox
     */
    private $cardbox;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set front
     *
     * @param string $front
     * @return Flashcard
     */
    public function setFront($front)
    {
        $this->front = $front;
    
        return $this;
    }

    /**
     * Get front
     *
     * @return string 
     */
    public function getFront()
    {
        return $this->front;
    }

    /**
     * Set back
     *
     * @param string $back
     * @return Flashcard
     */
    public function setBack($back)
    {
        $this->back = $back;
    
        return $this;
    }

    /**
     * Get back
     *
     * @return string 
     */
    public function getBack()
    {
        return $this->back;
    }

    /**
     * Set declaration
     *
     * @param string $declaration
     * @return Flashcard
     */
    public function setDeclaration($declaration)
    {
        $this->declaration = $declaration;
    
        return $this;
    }

    /**
     * Get declaration
     *
     * @return string 
     */
    public function getDeclaration()
    {
        return $this->declaration;
    }

    /**
     * Set cardbox
     *
     * @param \Matteo\LearnBundle\Entity\Cardbox $cardbox
     * @return Flashcard
     */
    public function setCardbox(\Matteo\LearnBundle\Entity\Cardbox $cardbox = null)
    {
        $this->cardbox = $cardbox;
    
        return $this;
    }

    /**
     * Get cardbox
     *
     * @return \Matteo\LearnBundle\Entity\Cardbox 
     */
    public function getCardbox()
    {
        return $this->cardbox;
    }
}