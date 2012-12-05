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
     * @var boolean $isActive
     */
    private $isActive;

    /**
     * @var Slumlords\Bundle\Entity\User
     */
    private $user;

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
     * Set user
     *
     * @param Slumlords\Bundle\Entity\User $user
     * @return Property
     */
    public function setUser(\Slumlords\Bundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return Slumlords\Bundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
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
