<?php

namespace Matteo\LearnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cardbox
 */
class Cardbox
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $difficulty;

    /**
     * @var integer
     */
    private $is_private;

    /**
     * @var string
     */
    private $front_side;

    /**
     * @var string
     */
    private $back_side;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $flashcard;

    /**
     * @var \Matteo\LearnBundle\Entity\Category
     */
    private $category;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->flashcard = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set name
     *
     * @param string $name
     * @return Cardbox
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Cardbox
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set difficulty
     *
     * @param integer $difficulty
     * @return Cardbox
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;
    
        return $this;
    }

    /**
     * Get difficulty
     *
     * @return integer 
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Set is_private
     *
     * @param integer $isPrivate
     * @return Cardbox
     */
    public function setIsPrivate($isPrivate)
    {
        $this->is_private = $isPrivate;
    
        return $this;
    }

    /**
     * Get is_private
     *
     * @return integer 
     */
    public function getIsPrivate()
    {
        return $this->is_private;
    }

    /**
     * Set front_side
     *
     * @param string $frontSide
     * @return Cardbox
     */
    public function setFrontSide($frontSide)
    {
        $this->front_side = $frontSide;
    
        return $this;
    }

    /**
     * Get front_side
     *
     * @return string 
     */
    public function getFrontSide()
    {
        return $this->front_side;
    }

    /**
     * Set back_side
     *
     * @param string $backSide
     * @return Cardbox
     */
    public function setBackSide($backSide)
    {
        $this->back_side = $backSide;
    
        return $this;
    }

    /**
     * Get back_side
     *
     * @return string 
     */
    public function getBackSide()
    {
        return $this->back_side;
    }

    /**
     * Add flashcard
     *
     * @param \Matteo\LearnBundle\Entity\Flashcard $flashcard
     * @return Cardbox
     */
    public function addFlashcard(\Matteo\LearnBundle\Entity\Flashcard $flashcard)
    {
        $this->flashcard[] = $flashcard;
    
        return $this;
    }

    /**
     * Remove flashcard
     *
     * @param \Matteo\LearnBundle\Entity\Flashcard $flashcard
     */
    public function removeFlashcard(\Matteo\LearnBundle\Entity\Flashcard $flashcard)
    {
        $this->flashcard->removeElement($flashcard);
    }

    /**
     * Get flashcard
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFlashcard()
    {
        return $this->flashcard;
    }

    /**
     * Set category
     *
     * @param \Matteo\LearnBundle\Entity\Category $category
     * @return Cardbox
     */
    public function setCategory(\Matteo\LearnBundle\Entity\Category $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Matteo\LearnBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @ORM\PrePersist
     */
    public function setSlugValue()
    {
        // Add your code here
    }
}