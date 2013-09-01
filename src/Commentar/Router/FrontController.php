<?php
/**
 * Front controller
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
    Commentar\Http\ResponseData;

/**
 * Front controller
 *
 * @category   Commentar
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class FrontController
{
    /**
     * @var \Commentar\Http\RequestData Instance of the request
     */
    private $request;

    /**
     * @var \Commentar\Http\ResponseData Instance of the response
     */
    private $response;

    /**
     * @var \Commentar\Router\Routable Request router
     */
    private $router;

    /**
     * Creates instance
     *
     * @param \Commentar\Http\RequestData  $request Instance of the request
     * @param \Commentar\Http\ResponseData $request Instance of the response
     * @param \Commentar\Router\Routable   $router  Request router
     */
    public function __construct(RequestData $request, ResponseData $response, Routable $router)
    {
        $this->request  = $request;
        $this->response = $response;
        $this->router   = $router;
    }

    /**
     * Disptaches the request
     */
    public function dispatch()
    {
        $route = $this->router->getRouteByRequest($this->request);

        $callback = $route->getCallback();
        $this->response->setBody($callback($this->request));
    }
}
