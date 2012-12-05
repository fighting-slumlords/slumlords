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
     *
     * @ORM\ManyToMany(targetEntity="MyProject\MyBundle\Entity\UserGroup")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")})
     */
    protected $group;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->courses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->group = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add group
     *
     * @param Slumlords\Bundle\Entity\UserGroup $group
     * @return User
     */
    public function addGroups(\Slumlords\Bundle\Entity\UserGroup $group)
    {
        $this->group[] = $group;
        return $this;
    }

    /**
     * Remove group
     *
     * @param Slumlords\Bundle\Entity\UserGroup $group
     */
    public function removeGroups(\Slumlords\Bundle\Entity\UserGroup $group)
    {
        $this->group-removeElement($group);
    }
    
    /**
     * Get groups
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getGroup()
    {
        return $this->group;
    }
    
}
