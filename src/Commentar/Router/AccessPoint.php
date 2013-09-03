<?php
/**
 * Interface for classes that represent a single route
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
 * Interface for classes that represent a single route
 *
 * @category   Commentar
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface AccessPoint
{
    /**
     * Checks whether the request matches with this route
     *
     * @param \Commentar\Http\RequestData $request The request to match
     *
     * @return boolean True when the route matches the request
     */
    public function doesRequestMatch(RequestData $request);

    /**
     * Gets the regex pattern of the URL path
     *
     * @return string The regex pattern of the URL path
     */
    public function getPath();

    /**
     * Gets the callback of the route
     *
     * @return callable The callback to run when the route matches
     */
    public function getCallback();
}
