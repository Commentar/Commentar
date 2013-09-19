<?php
/**
 * Array access storage useful as a wrapper around the superglobals for example
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
 * Array access storage useful as a wrapper around the superglobals for example
 *
 * @category   Commentar
 * @package    Storage
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class ArrayStorage implements KeyValue
{
    /**
     * @var array The array
     */
    private $array;

    /**
     * Creates instance
     *
     * @param array $array The array
     */
    public function __construct(array $array = [])
    {
        $this->array = $array;
    }

    /**
     * Gets a value from the storage based on the key or null on non existent key
     *
     * @param string $key     The key of which to get the value for
     * @param string $default The default value to return when the key does not exist
     *
     * @return mixed The value which belongs to the key or the default value
     */
    public function get($key, $default = null)
    {
        if ($this->isKeyValid($key)) {
            return $this->array[$key];
        }

        return $default;
    }

    /**
     * Sets a value in the storage for the key
     *
     * @param string $key   The key of which to set the value for
     * @param string $value The value
     */
    public function set($key, $value)
    {
        $this->array[$key] = $value;
    }

    /**
     * Checks whether the key is in the storage
     *
     * @return boolean true when the key is valid
     */
    public function isKeyValid($key)
    {
        return array_key_exists($key, $this->array);
    }

    /**
     * Deletes an item from the storage based on the key
     *
     * @param string $key The key of item to delete from the storage
     */
    public function delete($key)
    {
        unset($this->array[$key]);
    }
}
