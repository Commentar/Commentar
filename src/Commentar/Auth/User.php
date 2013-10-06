<?php
/**
 * Authentication class for users
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    Auth
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\Auth;

use Commentar\DomainObject\User as UserDomainObject;

/**
 * Authentication class for users
 *
 * @category   Commentar
 * @package    Auth
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class User implements Authenticator
{
    /**
     * @var \Commentar\DomainObject\User The user domain object
     */
    private $user;

    /**
     * Creates instance
     *
     * @param array $session The session data
     */
    public function __construct(array $session)
    {
        if (isset($session['commentar_user'])) {
            $this->user = unserialize($session['commentar_user']);
        }
    }

    /**
     * Stores the authenticated user
     *
     * @param \Commentar\DomainObject\User $user The user domain object
     */
    public function login(UserDomainObject $user)
    {
        $this->user = $user;
    }

    /**
     * Logs the user out
     */
    public function logout()
    {
        $this->user = null;
    }

    /**
     * Checks whether the current user is authenticated
     *
     * @return boolean True when the current user is authenticated
     */
    public function isLoggedIn()
    {
        return $this->user !== null;
    }

    /**
     * Gets the id of the user currently logged in
     *
     * @return null|int The id of the currently logged in user
     */
    public function getId()
    {
        if (!$this->isLoggedIn()) {
            return null;
        }

        return $this->user->getId();
    }

    /**
     * Checks whether the currently authenticated user is an admin
     *
     * @return boolean True when the currently authenticated user is an admin
     */
    public function isAdmin()
    {
        if ($this->isLoggedIn()) {
            return $this->user->isAdmin();
        }

        return false;
    }

    /**
     * Gets the authenticated user
     *
     * @return null|\Commentar\DomainObject\User The currently authenticated user if any
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Gets the serialized user domain object for storage in the session
     *
     * @return null|string The serialized user domain object if logged in
     */
    public function getUserForSession()
    {
        if ($this->isLoggedIn()) {
            return serialize($this->user);
        }

        return null;
    }
}
