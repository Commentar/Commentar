<?php
/**
 * Session class
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
 * Session class
 *
 * @category   Commentar
 * @package    Storage
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Session implements SessionInterface
{
    /**
     * Sets the value
     *
     * @param string $key   The key in which to store the value
     * @param mixed  $value The value to store
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Gets a value from the session superglobal
     *
     * @param mixed $key     The key of which to retrieve the value
     * @param mixed $default The default value
     *
     * @return mixed The value
     * @throws \Commentar\Storage\InvalidKeyException When the key is not found and no default is set
     */
    public function get($key, $default = null)
    {
        if (!$this->isKeyValid($key)) {
            if ($default === null) {
                throw new InvalidKeyException('Key (`' . $key . '`) not found in session.');
            }

            return $default;
        }

        return $_SESSION[$key];
    }

    /**
     * Check whether the supplied key is valid (i.e. does exist in the session superglobal)
     *
     * @param string $key The key to check
     *
     * @return boolean Whether the supplied key is valid
     */
    public function isKeyValid($key)
    {
        if (array_key_exists($key, $_SESSION)) {
            return true;
        }

        return false;
    }

    /**
     * Deletes an item from the storage based on the key
     *
     * @param string $key The key of item to delete from the storage
     */
    public function delete($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Regenerates a new session id and initializes the session superglobal
     *
     * @codeCoverageIgnore
     */
    public function regenerate()
    {
        session_regenerate_id(true);
        $_SESSION = [];
    }
}
