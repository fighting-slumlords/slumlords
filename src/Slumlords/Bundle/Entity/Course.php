<?php

namespace Slumlords\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Slumlords\Bundle\Entity\Course
 */
class Course
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $columns
     */
    private $columns;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var integer $rows
     */
    private $rows;

    /**
     * @var boolean $active
     */
    private $active;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set columns
     *
     * @param integer $columns
     * @return Course
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
    
        return $this;
    }

    /**
     * Get columns
     *
     * @return integer 
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Course
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set rows
     *
     * @param integer $rows
     * @return Course
     */
    public function setRows($rows)
    {
        $this->rows = $rows;
    
        return $this;
    }

    /**
     * Get rows
     *
     * @return integer 
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Course
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Add users
     *
     * @param Slumlords\Bundle\Entity\User $users
     * @return Course
     */
    public function addUser(\Slumlords\Bundle\Entity\User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param Slumlords\Bundle\Entity\User $users
     */
    public function removeUser(\Slumlords\Bundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
