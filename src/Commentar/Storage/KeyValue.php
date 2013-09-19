<?php
/**
 * Interface for key value pair storage
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
 * Interface for key value pair storage
 *
 * @category   Commentar
 * @package    Storage
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface KeyValue
{
    /**
     * Gets a value from the storage based on the key or null on non existent key
     *
     * @param string $key     The key of which to get the value for
     * @param string $default The default value to return when the key does not exist
     *
     * @return mixed The value which belongs to the key or the default value
     */
    public function get($key, $default = null);

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

    /**
     * Deletes an item from the storage based on the key
     *
     * @param string $key The key of item to delete from the storage
     */
    public function delete($key);
}
