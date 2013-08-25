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

use Commentar\Storage\KeyValue;

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
     * @var \Commentar\Storage\KeyValue The GET variables
     */
    private $getVariables;

    /**
     * @var \Commentar\Storage\KeyValue The POST variables
     */
    private $postVariables;

    /**
     * @var \Commentar\Storage\KeyValue The SERVER variables
     */
    private $serverVariables;

    /**
     * @var \Commentar\Storage\KeyValue The FILES variables
     */
    private $filesVariables;

    /**
     * Creates instance
     *
     * @param \Commentar\Storage\KeyValue $getVariables    The GET variables
     * @param \Commentar\Storage\KeyValue $postVariables   The POST variables
     * @param \Commentar\Storage\KeyValue $serverVariables The SERVER variables
     * @param \Commentar\Storage\KeyValue $filesVariables  The FILES variables
     */
    public function __construct(
        KeyValue $getVariables,
        KeyValue $postVariables,
        KeyValue $serverVariables,
        KeyValue $filesVariables
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
     * Gets the requested path
     *
     * @return string The requested path
     */
    public function getPath()
    {
        return preg_replace('/\?.*/', '', $this->serverVariables->get('REQUEST_URI'));
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
     * Checks whether the request is a resource. I.e. image, stylesheet etc
     *
     * @return boolean True when the request is a resource
     */
    public function isResource()
    {
        return preg_match('/\.(js|css|ico|gif|jpg|jpeg|otf|eot|svg|ttf|woff)$/', $this->getPath()) === 1;
    }
}
