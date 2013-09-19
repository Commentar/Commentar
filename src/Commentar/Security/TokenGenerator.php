<?php
/**
 * Interface for token generators (i.e. csrf tokens)
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    Security
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\Security;

/**
 * Interface for token generators (i.e. csrf tokens)
 *
 * @category   Commentar
 * @package    Security
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface TokenGenerator
{
    /**
     * Gets the stored CSRF token
     *
     * @return string The stored CSRF token
     */
    public function getToken();

    /**
     * Validates the supplied token against the stored token
     *
     * @return boolean True when the supplied token matches the stored token
     */
    public function validate($token);

    /**
     * Regenerates a new token
     */
    public function regenerateToken();
}
