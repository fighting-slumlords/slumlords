<?php

namespace Slumlords\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Slumlords\Bundle\Entity\User
 */
class User extends BaseUser
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $classes;

    /**
     * @var string $firstName
     */
    private $firstName;

    /**
     * @var string $lastName
     */
    private $lastName;

    /**
     * @var decimal $wage
     */
    private $wage;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $courses;

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
     * @param decimal $wage
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
     * @return string 
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $property;

    /**
     * Add property
     *
     * @param Slumlords\Bundle\Entity\Property $property
     * @return User
     */
    public function addProperty(\Slumlords\Bundle\Entity\Property $property)
    {
        $this->property[] = $property;
    
        return $this;
    }

    /**
     * Remove property
     *
     * @param Slumlords\Bundle\Entity\Property $property
     */
    public function removeProperty(\Slumlords\Bundle\Entity\Property $property)
    {
        $this->property->removeElement($property);
    }

    /**
     * Get property
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getProperty()
    {
        return $this->property;
    }
}