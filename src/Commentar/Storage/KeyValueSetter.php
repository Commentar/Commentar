<?php
/**
 * Interface for key value pair storage setters
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
 * Interface for key value pair storage setters
 *
 * @category   Commentar
 * @package    Storage
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface KeyValueSetter
{
    /**
     * Sets a value in the storage for the key
     *
     * @param string $key   The key of which to set the value for
     * @param string $value The value
     */
    public function set($key, $value);

    /**
     * Checks whether the key is in the storage
     *
     * @return boolean true when the key is valid
     */
    public function isKeyValid($key);
}
