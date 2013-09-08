<?php
/**
 * HTTP response object interface
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
 * HTTP response object interface
 *
 * @category   Commentar
 * @package    Http
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface ResponseData
{
    /**
     * Sets the status code of the response
     *
     * @param string $statusCode The status code of the response
     */
    public function setStatusCode($statusCode);

    /**
     * Adds a header
     *
     * @param string $key   The key of the header
     * @param string $value The value of the header
     */
    public function addHeader($key, $value);

    /**
     * Set the response content type
     *
     * @param string $contentType The content type
     */
    public function setContentType($contentType);

    /**
     * Sets the content length
     *
     * @param int $contentLength The content length
     */
    public function setContentLength($contentLength);

    /**
     * Sets the last modified header
     *
     * @param string $timestamp The timestamp the resource is last modified at
     */
    public function setLastModified($timestamp);

    /**
     * Adds body to the response
     *
     * @param string $content The body content
     */
    public function setBody($content);

    /**
     * Renders the response
     *
     * @return string The body of the response
     */
    public function render();
}
