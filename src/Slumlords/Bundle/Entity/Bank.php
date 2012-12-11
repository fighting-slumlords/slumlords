<?php

namespace Slumlords\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Slumlords\Bundle\Entity\Bank
 */
class Bank
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
     * @var float $balance
     */
    private $balance;

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
     * Set accountID
     *
     * @param integer $accountID
     * @return Bank
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
     * Add balance
     *
     * @param float $balance
     * @return Bank
     */
    public function addBalance($balance)
    {
        $this->balance += $balance;
    
        return $this;
    }

    /**
     * Set balance
     *
     * @param float $balance
     * @return Bank
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    
        return $this;
    }

    /**
     * Get balance
     *
     * @return float 
     */
    public function getBalance()
    {
        return $this->balance;
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