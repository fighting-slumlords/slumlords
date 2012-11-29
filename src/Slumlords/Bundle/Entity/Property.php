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
}
