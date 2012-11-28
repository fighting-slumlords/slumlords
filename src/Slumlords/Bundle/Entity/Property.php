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
     * @var integer $accountID
     */
    private $accountID;

    /**
     * @var float $rent
     */
    private $rent;

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
     * Set accountID
     *
     * @param integer $accountID
     * @return Property
     */
    public function setAccountID($accountID)
    {
        $this->accountID = $accountID;
    
        return $this;
    }

    /**
     * Get accountID
     *
     * @return integer 
     */
    public function getAccountID()
    {
        return $this->accountID;
    }

    /**
     * Set rent
     *
     * @param integer $rent
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
     * @var Slumlords\Bundle\Entity\User
     */
    private $user;


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
     * @var Slumlords\Bundle\Entity\Course
     */
    private $course;


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