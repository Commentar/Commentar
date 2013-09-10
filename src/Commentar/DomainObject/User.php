<?php
/**
 * User domain object
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    DomainObject
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\DomainObject;

/**
 * User domain object
 *
 * @category   Commentar
 * @package    DomainObject
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class User
{
    /**
     * @var int The id of the user
     */
    protected $id;

    /**
     * @var string The username
     */
    protected $username;

    /**
     * @var string The emailaddress
     */
    protected $email;

    /**
     * @var boolean Whether the user is hellbanned
     */
    protected $isHellbanned = false;

    /**
     * @var boolean Whether the user is admin
     */
    protected $isAdmin = false;

    /**
     * Fills the object with data
     *
     * @param array $data The data used to fill the object
     *
     * @throws \Commentar\DomainObjects\InvalidPropertyException When trying to fill an undefined property
     */
    public function fill(array $data)
    {
        foreach ($data as $name => $value) {
            if (!property_exists($this, $name)) {
                throw new InvalidPropertyException('Trying to fill an invalid property (`' . $name . '`).');
            }

            $setter = 'set' . ucfirst(strtolower($name));
            $this->$setter($value);
        }
    }

    /**
     * Sets the id of the user
     *
     * @param int $id The id of the user
     */
    protected function setId($id)
    {
        $this->id = (int) $id;
    }

    /**
     * Gets the id of the user
     *
     * @return int The id of the user
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the username
     *
     * @param string The username
     */
    protected function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Gets the username
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the emailaddress
     *
     * @param string $email The emailaddress
     *
     * @throws \Commentar\DomainObject\InvalidValueException When an invalid emailaddress is supplied
     */
    protected function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidValueException('Invalid emailaddress supplied.');
        }

        $this->email = $email;
    }

    /**
     * Gets the emailaddress
     *
     * @return string The emailaddress
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the hellbanned status of the user
     *
     * @param boolean $hellbanned Whether the user is hellbanned
     */
    protected function setIsHellbanned($status)
    {
        $this->isHellbanned = (bool) $status;
    }

    /**
     * Gets the hellbanned status of the user
     *
     * @return boolean Whether the user is hellbanned
     */
    public function isHellbanned()
    {
        return $this->isHellbanned;
    }

    /**
     * Sets the admin status of the user
     *
     * @param boolean $isAdmin Whether the user is an admin
     */
    protected function setIsAdmin($isAdmin)
    {
        $this->isAdmin = (bool) $isAdmin;
    }

    /**
     * Sets the admin status of the user
     *
     * @return boolean Whether the user is an admin
     */
    public function isAdmin()
    {
        return $this->isAdmin;
    }
}
