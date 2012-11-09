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
}