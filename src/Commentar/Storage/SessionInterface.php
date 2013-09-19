<?php
/**
 * Session interface
 *
 * All classes which represent a session should implement this. This is useful for creating a mock session class.
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    Storage
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\Storage;

/**
 * Session interface
 *
 * @category   Commentar
 * @package    Storage
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface SessionInterface extends KeyValue
{
    /**
     * Regenerates a new session id and initializes the session superglobal
     */
    public function regenerate();
}
