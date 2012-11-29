<?php

namespace Slumlords\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * Slumlords\Bundle\Entity\User
 */
class User extends BaseUser
{
    /**
     * @var string $firstName
     */
    private $firstName;

    /**
     * @var string $lastName
     */
    private $lastName;

    /**
     * @var float $wage
     */
    private $wage;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $courses;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $properties;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->courses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->properties = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set wage
     *
     * @param float $wage
     * @return User
     */
    public function setWage($wage)
    {
        $this->wage = $wage;
    
        return $this;
    }

    /**
     * Get wage
     *
     * @return float 
     */
    public function getWage()
    {
        return $this->wage;
    }

    /**
     * Add courses
     *
     * @param Slumlords\Bundle\Entity\Course $courses
     * @return User
     */
    public function addCourse(\Slumlords\Bundle\Entity\Course $courses)
    {
        $this->courses[] = $courses;
    
        return $this;
    }

    /**
     * Remove courses
     *
     * @param Slumlords\Bundle\Entity\Course $courses
     */
    public function removeCourse(\Slumlords\Bundle\Entity\Course $courses)
    {
        $this->courses->removeElement($courses);
    }

    /**
     * Get courses
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * Add properties
     *
     * @param Slumlords\Bundle\Entity\Property $properties
     * @return User
     */
    public function addProperty(\Slumlords\Bundle\Entity\Property $properties)
    {
        $this->properties[] = $properties;
    
        return $this;
    }

    /**
     * Remove properties
     *
     * @param Slumlords\Bundle\Entity\Property $properties
     */
    public function removeProperty(\Slumlords\Bundle\Entity\Property $properties)
    {
        $this->properties->removeElement($properties);
    }

    /**
     * Get properties
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getProperties()
    {
        return $this->properties;
    }
}
