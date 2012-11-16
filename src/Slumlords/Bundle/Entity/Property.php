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
}
