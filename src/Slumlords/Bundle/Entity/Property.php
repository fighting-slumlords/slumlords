<?php

namespace Slumlords\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Slumlords\Bundle\Entity\Property
 */
class Property
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var float $rent
     */
    private $rent;

    /**
     * @var float $price
     */
    private $price;


    /**
     * @var boolean $isActive
     */
    private $isActive;

    /**
     * @var Slumlords\Bundle\Entity\User
     */
    private $renter;

    /**
     * @var Slumlords\Bundle\Entity\User
     */
    private $owner;

    /**
     * @var Slumlords\Bundle\Entity\Course
     */
    private $course;


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
     * Set rent
     *
     * @param float $rent
     * @return Property
     */
    public function setRent($rent)
    {
        $this->rent = $rent;
    
        return $this;
    }

    /**
     * Get rent
     *
     * @return float 
     */
    public function getRent()
    {
        return $this->rent;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Property
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Property
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set renter
     *
     * @param Slumlords\Bundle\Entity\User $user
     * @return Property
     */
    public function setRenter(\Slumlords\Bundle\Entity\User $user = null)
    {
        $this->renter = $user;
    
        return $this;
    }

    /**
     * Get renter
     *
     * @return Slumlords\Bundle\Entity\User 
     */
    public function getRenter()
    {
        return $this->renter;
    }


    /**
     * Set owner
     *
     * @param Slumlords\Bundle\Entity\User $user
     * @return Property
     */
    public function setOwner(\Slumlords\Bundle\Entity\User $user = null)
    {
        $this->owner = $user;
    
        return $this;
    }

    /**
     * Get owner
     *
     * @return Slumlords\Bundle\Entity\User 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set course
     *
     * @param Slumlords\Bundle\Entity\Course $course
     * @return Property
     */
    public function setCourse(\Slumlords\Bundle\Entity\Course $course = null)
    {
        $this->course = $course;
    
        return $this;
    }

    /**
     * Get course
     *
     * @return Slumlords\Bundle\Entity\Course 
     */
    public function getCourse()
    {
        return $this->course;
    }
}
