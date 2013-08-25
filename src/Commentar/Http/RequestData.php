<?php
/**
 * HTTP request object interface
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    Http
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\Http;

/**
 * HTTP request object interface
 *
 * @category   Commentar
 * @package    Http
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface RequestData
{
    /**
     * Gets a value from the GET variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function get($key, $defaultValue = null);

    /**
     * Gets a value from the POST variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function post($key, $defaultValue = null);

    /**
     * Gets a value from the SERVER variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function server($key, $defaultValue = null);

    /**
     * Gets a value from the FILES variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function files($key, $defaultValue = null);

    /**
     * Gets the requested path
     *
     * @return string The requested path
     */
    public function getPath();

    /**
     * Checks whether the request is an XHR request
     *
     * When sending an xhr request clients should manually the `X-Requested-With` header.
     *
     * @return boolean True when it is an xhr request
     */
    public function isXhr();

    /**
     * Checks whether the request is made over a secure (SSL/TLS) connection
     *
     * @return boolean True when the connection is secure
     */
    public function isSecure();

    /**
     * Checks whether the request is a resource. I.e. image, stylesheet etc
     *
     * @return boolean True when the request is a resource
     */
    public function isResource();
}
