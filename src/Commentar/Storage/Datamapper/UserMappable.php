<?php
/**
 * Interface for user storage mappers
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    Storage
 * @subpackage Datamapper
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\Storage\Datamapper;

use Commentar\DomainObject\User as UserDomainObject;

/**
 * Interface for user storage mappers
 *
 * @category   Commentar
 * @package    Storage
 * @subpackage Datamapper
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface UserMappable
{
    /**
     * Gets the user based on the id
     *
     * @param int $id The id of the user
     *
     * @return null|array The user
     */
    public function fetchById(UserDomainObject $user, $id);

    /**
     * Gets the user based on the username
     *
     * @param \Commentar\DomainObject\User $user The user domain object
     */
    public function fetchByUsername(UserDomainObject $user);

    /**
     * Persists the data of the user in the storage file
     *
     * @param \Commentar\DomainObject\User $user The user to store
     */
    public function persist(UserDomainObject $user);
}
