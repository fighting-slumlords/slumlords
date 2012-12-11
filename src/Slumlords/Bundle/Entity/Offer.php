<?php

namespace Slumlords\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 */
class Offer
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var \Slumlords\Bundle\Entity\User
     */
    private $buyer;

    /**
     * @var \Slumlords\Bundle\Entity\Property
     */
    private $property;


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
     * Set amount
     *
     * @param float $amount
     * @return Offer
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    
        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set buyer
     *
     * @param \Slumlords\Bundle\Entity\User $buyer
     * @return Offer
     */
    public function setBuyer(\Slumlords\Bundle\Entity\User $buyer = null)
    {
        $this->buyer = $buyer;
    
        return $this;
    }

    /**
     * Get buyer
     *
     * @return \Slumlords\Bundle\Entity\User 
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * Set property
     *
     * @param \Slumlords\Bundle\Entity\Property $property
     * @return Offer
     */
    public function setProperty(\Slumlords\Bundle\Entity\Property $property = null)
    {
        $this->property = $property;
    
        return $this;
    }

    /**
     * Get property
     *
     * @return \Slumlords\Bundle\Entity\Property 
     */
    public function getProperty()
    {
        return $this->property;
    }
    /**
     * @var string
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $timestamp;


    /**
     * Set status
     *
     * @param string $status
     * @return Offer
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return Offer
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    
        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}