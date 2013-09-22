<?php
/**
 * Service for users
 *
 * This service acts like a proxy in between the the application and the chosen datamapper(s) / domainobject(s)
 * combination.
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    Service
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\Service;

use Commentar\DomainObject\Builder as DomainObjectBuilder;
use Commentar\Storage\Datamapper\Builder as DatamapperBuilder;
use Commentar\Http\RequestData;
use Commentar\Auth\Authenticator;

/**
 * Service for users
 *
 * @category   Commentar
 * @package    Service
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class User
{
    /**
     * @var \Commentar\DomainObject\Builder Instance of a domain object factory
     */
    private $domainObjectFactory;

    /**
     * @var \Commentar\Storage\Datamapper\Builder Instance of a datamapper factory
     */
    private $datamapperFactory;

    /**
     * Creates instance
     *
     * @param \Commentar\DomainObject\Builder       $domainObjectFactory Instance of a domain object factory
     * @param \Commentar\Storage\Datamapper\Builder $datamapperFactory   Instance of a datamapper factory
     */
    public function __construct(DomainObjectBuilder $domainObjectFactory, DatamapperBuilder $datamapperFactory)
    {
        $this->domainObjectFactory = $domainObjectFactory;
        $this->datamapperFactory   = $datamapperFactory;
    }

    /**
     * Attempts to log the user in
     *
     * @param \Commentar\Http\RequestData   $request The HTTP request
     * @param \Commentar\Auth\Authenticator $auth    The authenticator instance
     *
     * @return boolean True when the user is logged in successfully
     */
    public function login(RequestData $request, Authenticator $auth)
    {
        $user = $this->domainObjectFactory->build('User');
        $user->fill([
            'username' => $request->post('username'),
        ]);

        $userMapper = $this->datamapperFactory->build('User');
        $userMapper->fetchByUsername($user);

        if (password_verify($request->post('password'), $user->getPassword())) {
            $user->fill(['password' => $this->rehashWhenNeeded($user->getPassword(), $request->post('password'))]);

            $auth->login($user);

            return true;
        }

        return false;
    }

    /**
     * Check whether the password needs rehashing and rehashes the password when needed
     *
     * @param string $hash     The stored hashed password
     * @param string $password The user supplied password
     *
     * @return string The new hash
     */
    private function rehashWhenNeeded($hash, $password)
    {
        if (password_needs_rehash($hash, PASSWORD_DEFAULT, ['cost' => 14])) {
            return password_hash($password, PASSWORD_DEFAULT, ['cost' => 14]);
        }

        return $hash;
    }
}
