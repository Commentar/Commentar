<?php
/**
 * Provides a storage mechanism for CSRF tokens based on a sessions
 *
 * PHP version 5.4
 *
 * @category      Commentar
 * @package       Security
 * @subpackage    CsrfToken
 * $subsubpackage StorageMedium
 * @author        Pieter Hordijk <info@pieterhordijk.com>
 * @copyright     Copyright (c) 2013 Pieter Hordijk
 * @license       http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version       1.0.0
 */
namespace Commentar\Security\CsrfToken\StorageMedium;

use Commentar\Security\CsrfToken\StorageMedium;
use Commentar\Storage\SessionInterface;

/**
 * Provides a storage mechanism for CSRF tokens based on a sessions
 *
 * @category      Commentar
 * @package       Security
 * @subpackage    CsrfToken
 * $subsubpackage StorageMedium
 * @author        Pieter Hordijk <info@pieterhordijk.com>
 */
class Session implements StorageMedium
{
    /**
     * @var string The key under which to store the token
     */
    private $key;

    /**
     * \Commentar\Storage\SessionInterface Instance of the session class
     */
    private $session;

    /**
     * Creates instance
     *
     * @param string                               $key     The key under which to store the token
     * @param \Commentar\Storage\SessionInterface $session Instance of the session class
     */
    public function __construct($key, SessionInterface $session)
    {
        $this->key     = $key;
        $this->session = $session;
    }

    /**
     * Sets the CSRF token
     *
     * @param string $token The token to store
     */
    public function set($token)
    {
        $this->session->set($this->key, $token);
    }

    /**
     * Gets the CSRF token
     *
     * @return string|null The CSRF token or null when there isn't a token stored (yet)
     */
    public function get()
    {
        if ($this->session->isKeyValid($this->key)) {
            return $this->session->get($this->key);
        }

        return null;
    }
}
