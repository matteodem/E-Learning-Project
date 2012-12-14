<?php

namespace Matteo\LearnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Matteo\LearnBundle\Utils\Slug as Slug;

/**
 * Category
 */
class Category
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
     * @var string
     */
    private $overview;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $cardbox;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cardbox = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * __toString for other Entities
     */
    public function __toString()
    {
        return $this->getName();
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
     * @return Category
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
     * @return Category
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
     * Add cardbox
     *
     * @param \Matteo\LearnBundle\Entity\Cardbox $cardbox
     * @return Category
     */
    public function addCardbox(\Matteo\LearnBundle\Entity\Cardbox $cardbox)
    {
        $this->cardbox[] = $cardbox;
    
        return $this;
    }

    /**
     * Remove cardbox
     *
     * @param \Matteo\LearnBundle\Entity\Cardbox $cardbox
     */
    public function removeCardbox(\Matteo\LearnBundle\Entity\Cardbox $cardbox)
    {
        $this->cardbox->removeElement($cardbox);
    }

    /**
     * Get cardbox
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCardbox()
    {
        return $this->cardbox;
    }

    /**
     * Set overview
     *
     * @param string $overview
     * @return Category
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;
    
        return $this;
    }

    /**
     * Get overview
     *
     * @return string 
     */
    public function getOverview()
    {
        return $this->overview;
    }
    
    public function getCategorySlug()
    {
        return Slug::slugify($this->getName());
    }
}