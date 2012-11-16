<?php

namespace Slumlords\Bundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @Assert\NotBlank(message="Please enter your first name.", groups={"Registration", "Profile"})
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @Assert\NotBlank(message="Please enter your last name.", groups={"Registration", "Profile"})
     */
    protected $lastName;

    /**
     * @ORM\Column(type="decimal")
     */
    protected $wage;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set firstName
     *
     * @return string
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
     * @return string
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
     * @return string
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
}
