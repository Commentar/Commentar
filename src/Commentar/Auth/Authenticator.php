<?php
/**
 * Interface for authentication classes for users
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
 * Interface for authentication classes for users
 *
 * @category   Commentar
 * @package    Auth
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Authenticator
{
    /**
     * Stores the authenticated user
     *
     * @param \Commentar\DomainObject\User $user The user domain object
     */
    public function login(UserDomainObject $user);

    /**
     * Logs the user out
     */
    public function logout();

    /**
     * Checks whether the current user is authenticated
     *
     * @return boolean True when the current user is authenticated
     */
    public function isLoggedIn();

    /**
     * Checks whether the currently authenticated user is an admin
     *
     * @return boolean True when the currently authenticated user is an admin
     */
    public function isAdmin();

    /**
     * Gets the authenticated user
     *
     * @return null|\Commentar\DomainObject\User The currently authenticated user if any
     */
    public function getUser();

    /**
     * Gets the serialized user domain object for storage in the session
     *
     * @return null|string The serialized user domain object if logged in
     */
    public function getUserForSession();
}
