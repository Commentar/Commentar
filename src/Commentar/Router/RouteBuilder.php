<?php
/**
 * Interface for route factories
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
 * Interface for route factories
 *
 * @category   Commentar
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface RouteBuilder
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
    public function build($name, $path, $method, callable $callback);
}
