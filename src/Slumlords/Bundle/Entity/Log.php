<?php

namespace Slumlords\Bundle\Entity;

use Doctrine\ORM\mapping as ORM;

/**
 * Slumlords\Bundle\Entity\Log
 */
class Log
{
    public function __construct() {
        // @TODO Set defaults, maybe
    }

    /**
     * @var integer $id
     */
    private $id;
    
    /**
     * @var string $logType
     */
    private $logType;
    
    /**
     * @var datetime $timestamp
     */
    private $timestamp;
    
    /**
     * @var decimal $amount
     */
    private $amount;
    
    /**
     * @var integer $targetID
     */
    private $targetID;
    
    /**
     * @var integer $originID
     */
    private $originID;

    /**
     * @var integer propertyID
     */
    private $propertyID;

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
     * Set logType
     *
     * @param string $logType
     * @return Log
     */
    public function setLogType($logType)
    {
        $this->logType = $logType;
    
        return $this;
    }

    /**
     * Get logType
     *
     * @return string 
     */
    public function getLogType()
    {
        return $this->logType;
    }

    /**
     * Set timestamp
     *
     * @param datetime $timestamp
     * @return Log
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        
        return $this;
    }

    /**
     * Get timestamp
     *
     * @return datetime
     */
    public function getTimestamp()
    {
       return $this->timestamp; 
    }
    
    /**
     * Set amount
     *
     * @param decimal $amount
     * @return Log
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        
        return $this;
    }
    
    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }
    
    /**
     * Set targetID
     *
     * @param integer $targetID
     * @return Log
     */
    public function setTargetID($targetID)
    { 
        $this->targetID = $targetID;
        
        return $this;
    }
    
    /**
     * Get targetID
     *
     * @return integer
     */
    public function getTargetID()
    {
        return $this->targetID;
    }
    
    /**
     * Set originID
     *
     * @param integer $originID
     * @return Log
     */
    public function setOriginID($originID)
    {
        $this->originID = $originID;
        
        return $this;
    }
    
    /**
     * Get originID
     * 
     * @return integer
     */
    public function getOriginID()
    {
        return $this->originID;
    }
    
    /**
     * Set propertyID
     *
     * @param integer $propertyID
     * @return Log
     */
    public function setPropertyID($propertyID)
    {
        $this->propertyID = $propertyID;
        
        return $this;
    }
    
    /**
     * Get propertyID
     *
     * @return integer
     */
    public function getPropertyID()
    {
        return $this->propertyID;
    }
}