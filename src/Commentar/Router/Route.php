<?php
/**
 * This class represent a single route
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\Router;

use Commentar\Http\RequestData;

/**
 * This class represent a single route
 *
 * @category   Commentar
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Route implements AccessPoint
{
    /**
     * @var string The name of the route
     */
    private $name;

    /**
     * @var string The regex pattern path to match
     */
    private $path;

    /**
     * @var string The method (HTTP verb) of the route
     */
    private $method;

    /**
     * @var callable The callback to run when the route matches
     */
    private $callback;

    /**
     * Create instance
     *
     * @param string   $name     The name of the route
     * @param string   $path     The regex pattern path to match
     * @param string   $method   The method (HTTP verb) of the route
     * @param callable $callback The callback to run when the route matches
     */
    public function __construct($name, $path, $method, callable $callback)
    {
        $this->name     = $name;
        $this->path     = $path;
        $this->method   = $method;
        $this->callback = $callback;
    }

    /**
     * Checks whether the request matches with this route
     *
     * @param \Commentar\Http\RequestData $request The request to match
     *
     * @return boolean True when the route matches the request
     */
    public function doesRequestMatch(RequestData $request)
    {
        return $this->doesMethodMatch($request->getMethod()) && $this->doesPathMatch($request->getPath());
    }

    /**
     * Checks whether the method (HTTP verb) matches the route
     *
     * @param string $method The method (HTTP verb)
     *
     * @return boolean True when the method matches the route
     */
    private function doesMethodMatch($method)
    {
        return strtolower($this->method) === strtolower($method);
    }

    /**
     * Check whether the path matches the route
     *
     * @param string $path Regex pattern of the path to match against the route
     *
     * @return boolean True when the path matches the route
     */
    private function doesPathMatch($path)
    {
        return preg_match($this->path, $path) === 1;
    }

    /**
     * Gets the callback of the route
     *
     * @return callable The callback to run when the route matches
     */
    public function getCallback()
    {
        return $this->callback;
    }
}
