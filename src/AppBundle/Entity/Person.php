<?php

namespace AppBundle\Entity;

/**
 * Person
 */
class Person
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var DictionaryItem
     */
    private $role;

    /**
     * @param null $name
     * @param DictionaryItem $role
     */
    public function __construct($name = null, DictionaryItem $role = null)
    {
        $this->name = $name;
        $this->role = $role;
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
     * Set name
     *
     * @param string $name
     *
     * @return Person
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
     * @return DictionaryItem
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param DictionaryItem $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function __toString()
    {
        return $this->name;
    }
}

