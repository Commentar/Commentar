<?php
/**
 * HTTP response object
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
 * HTTP response object
 *
 * @category   Commentar
 * @package    Http
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Response implements ResponseData
{
    /**
     * @var array The headers to be send
     */
    private $headers = [];

    /**
     * @var string The response body
     */
    private $body;

    /**
     * Adds a header
     *
     * @param string $key   The key of the header
     * @param string $value The value of the header
     */
    public function addHeader($key, $value)
    {
        if (!array_key_exists($key, $this->headers)) {
            $this->headers[$key] = [];
        }

        $this->headers[$key][] = $value;
    }

    /**
     * Set the response content type
     *
     * @param string $contentType The content type
     */
    public function setContentType($contentType)
    {
        $this->headers['Content-Type'] = $contentType;
    }

    /**
     * Adds body to the response
     *
     * @param string $content The body content
     */
    public function setBody($content)
    {
        $this->body = $content;
    }

    /**
     * Renders the response
     *
     * @return string The body of the response
     */
    public function render()
    {
        $this->renderHeaders();

        return $this->body;
    }

    /**
     * Renders the HTTP headers
     */
    private function renderHeaders()
    {
        foreach ($this->headers as $key => $headersOrValue) {
            if (!is_array($headersOrValue)) {
                $value = $headersOrValue;
            } elseif (count($headersOrValue) === 1) {
                $value = $headersOrValue[0];
            } else {
                $value = implode(',', $headersOrValue);
            }

            header($key . ': ' . $value);
        }
    }
}
