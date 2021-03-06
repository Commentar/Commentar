<?php
/**
 * HTTP request object
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

use Commentar\Storage\KeyValueGetter;

/**
 * HTTP request object
 *
 * @category   Commentar
 * @package    Http
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Request implements RequestData
{
    /**
     * @var \Commentar\Storage\KeyValueGetter The GET variables
     */
    private $getVariables;

    /**
     * @var \Commentar\Storage\KeyValueGetter The POST variables
     */
    private $postVariables;

    /**
     * @var \Commentar\Storage\KeyValueGetter The SERVER variables
     */
    private $serverVariables;

    /**
     * @var \Commentar\Storage\KeyValueGetter The FILES variables
     */
    private $filesVariables;

    /**
     * @var array The URL path variables
     */
    private $paramVariables = [];

    /**
     * Creates instance
     *
     * @param \Commentar\Storage\KeyValueGetter $getVariables    The GET variables
     * @param \Commentar\Storage\KeyValueGetter $postVariables   The POST variables
     * @param \Commentar\Storage\KeyValueGetter $serverVariables The SERVER variables
     * @param \Commentar\Storage\KeyValueGetter $filesVariables  The FILES variables
     */
    public function __construct(
        KeyValueGetter $getVariables,
        KeyValueGetter $postVariables,
        KeyValueGetter $serverVariables,
        KeyValueGetter $filesVariables
    ) {
        $this->getVariables    = $getVariables;
        $this->postVariables   = $postVariables;
        $this->serverVariables = $serverVariables;
        $this->filesVariables  = $filesVariables;
    }

    /**
     * Gets a value from the GET variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function get($key, $defaultValue = null)
    {
        return $this->getVariables->get($key, $defaultValue);
    }

    /**
     * Gets a value from the POST variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function post($key, $defaultValue = null)
    {
        return $this->postVariables->get($key, $defaultValue);
    }

    /**
     * Gets a value from the SERVER variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function server($key, $defaultValue = null)
    {
        return $this->serverVariables->get($key, $defaultValue);
    }

    /**
     * Gets a value from the FILES variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function files($key, $defaultValue = null)
    {
        return $this->filesVariables->get($key, $defaultValue);
    }

    /**
     * Sets the parameters based on the URL path
     *
     * @param array $params The URL parameters
     */
    public function setParameters(array $params)
    {
        $this->paramVariables = $params;
    }

    /**
     * Gets a value fro the URL parameters
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function param($key, $defaultValue = null)
    {
        return array_key_exists($key, $this->paramVariables) ? $this->paramVariables[$key] : $defaultValue;
    }

    /**
     * Gets the requested path
     *
     * @return string The requested path
     */
    public function getPath()
    {
        return preg_replace('/\?.*/', '', $this->serverVariables->get('REQUEST_URI'));
    }

    /**
     * Gets the HTTP method used
     *
     * @return string The HTTP method used
     */
    public function getMethod()
    {
        return $this->server('REQUEST_METHOD');
    }

    /**
     * Checks whether the request is an XHR request
     *
     * When sending an xhr request clients should manually the `X-Requested-With` header.
     *
     * @return boolean True when it is an xhr request
     */
    public function isXhr()
    {
        return $this->serverVariables->get('X-Requested-With') === 'XMLHttpRequest';
    }

    /**
     * Checks whether the request is made over a secure (SSL/TLS) connection
     *
     * @return boolean True when the connection is secure
     */
    public function isSecure()
    {
        $https = $this->serverVariables->get('HTTPS');

        return (!empty($https) && $https !== 'off');
    }

    /**
     * Gets the base URL
     *
     * The base URL is build using the current protocol and hostname
     *
     * @return string The base URL
     */
    public function getBaseUrl()
    {
        $baseUrl = $this->isSecure() ? 'https://' : 'http://';

        return $baseUrl . $this->server('SERVER_NAME');
    }
}
