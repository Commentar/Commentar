<?php
/**
 * Routing system
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

use Commentar\Http\RequestData,
    Commentar\Router\RouteBuilder;

/**
 * Routing system
 *
 * @category   Commentar
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Router implements Routable
{
    /**
     * @var array List of defined routers
     */
    private $routes = [
        'GET'  => [],
        'POST' => [],
    ];

    /**
     * @var \Commentar\Router\RouteBuilder Instance of a route builder
     */
    private $routeFactory;

    /**
     * Creates instance
     *
     * @param \Commentar\Router\RouteBuilder $routeFactory Instance of a route builder
     */
    public function __construct(RouteBuilder $routeFactory)
    {
        $this->routeFactory = $routeFactory;
    }

    /**
     * Adds a GET route to the list
     *
     * @param string   $name     The name of the route
     * @param string   $path     The path of the route (regex pattern)
     * @param callable $callback The callback of the route
     */
    public function get($name, $path, callable $callback)
    {
        $this->addRoute($name, $path, 'GET', $callback);
    }

    /**
     * Adds a POST route to the list
     *
     * @param string   $name     The name of the route
     * @param string   $path     The path of the route (regex pattern)
     * @param callable $callback The callback of the route
     */
    public function post($name, $path, callable $callback)
    {
        $this->addRoute($name, $path, 'POST', $callback);
    }

    /**
     * Adds a route to the routing system
     *
     * @param string   $name     The name of the route
     * @param string   $path     Regex pattern of the path of the route
     * @param string   $method   The method (HTTP verb) of the route
     * @param callable $callback The callback of the route
     */
    private function addRoute($name, $path, $method, callable $callback)
    {
        $this->routes[$method][$name] = $this->routeFactory->build($name, $path, $method, $callback);
    }

    /**
     * Gets the route based on the current request
     *
     * When no route matches it tries to load the 404 route. When that also is not defined it will throw up.
     *
     * @param \Commentar\Http\RequestData $request The request object
     *
     * @return \Commentar\Router\AccessPoint The matching route
     * @throws \Commentar\Router\NoMatchingRouteException When no route matches and no 404 route exists
     */
    public function getRouteByRequest(RequestData $request)
    {
        foreach ($this->routes[$request->getMethod()] as $route) {
            if ($route->doesRequestMatch($request)) {
                return $route;
            }
        }

        if (array_key_exists('404', $this->routes['GET'])) {
            return $this->routes['GET']['404'];
        }

        throw new NoMatchingRouteException('Found no matching route for the current request.');
    }
}
