<?php
/**
 * This factory creates routes on demand
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

/**
 * This factory creates routes on demand
 *
 * @category   Commentar
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class RouteFactory implements RouteBuilder
{
    /**
     * Builds a new route
     *
     * @param string $name       The name of the route
     * @param string $path       The regex pattern of the path of the route
     * @param string $method     The method (HTTP verb) of the route
     * @param callable $callback The callback of the route
     *
     * @return \Commentar\Router\AccessPoint The newle created instance of the route
     */
    public function build($name, $path, $method, callable $callback)
    {
        return new Route($name, $path, $method, $callback);
    }
}
