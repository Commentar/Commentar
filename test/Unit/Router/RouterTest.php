<?php

namespace CommentarTest\Router;

use Commentar\Router\Router;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Router\Router::__construct
     */
    public function testConstructCorrectInterface()
    {
        $router = new Router($this->getMock('\\Commentar\\Router\\RouteBuilder'));

        $this->assertInstanceOf('\\Commentar\\Router\\Routable', $router);
    }

    /**
     * @covers Commentar\Router\Router::__construct
     */
    public function testConstructCorrectInstance()
    {
        $router = new Router($this->getMock('\\Commentar\\Router\\RouteBuilder'));

        $this->assertInstanceOf('\\Commentar\\Router\\Router', $router);
    }

    /**
     * @covers Commentar\Router\Router::__construct
     * @covers Commentar\Router\Router::get
     * @covers Commentar\Router\Router::addRoute
     */
    public function testGet()
    {
        $router = new Router($this->getMock('\\Commentar\\Router\\RouteBuilder'));

        $this->assertNull($router->get('foo', '#/bar#', function() {
            return 'baz';
        }));
    }

    /**
     * @covers Commentar\Router\Router::__construct
     * @covers Commentar\Router\Router::post
     * @covers Commentar\Router\Router::addRoute
     */
    public function testPost()
    {
        $router = new Router($this->getMock('\\Commentar\\Router\\RouteBuilder'));

        $this->assertNull($router->post('foo', '#/bar#', function() {
            return 'baz';
        }));
    }

    /**
     * @covers Commentar\Router\Router::__construct
     * @covers Commentar\Router\Router::getRouteByRequest
     */
    public function testGetRouteByRequestNoRoutes()
    {
        $router = new Router($this->getMock('\\Commentar\\Router\\RouteBuilder'));

        $request = $this->getMock('\\Commentar\\Http\\RequestData');
        $request->expects($this->any())->method('getMethod')->will($this->returnValue('GET'));

        $this->setExpectedException('\\Commentar\\Router\\NoMatchingRouteException');

        $route = $router->getRouteByRequest($request);
    }

    /**
     * @covers Commentar\Router\Router::__construct
     * @covers Commentar\Router\Router::get
     * @covers Commentar\Router\Router::addRoute
     * @covers Commentar\Router\Router::getRouteByRequest
     */
    public function testGetRouteByRequestMatchesFirst()
    {
        $route1 = $this->getMock('\\Commentar\\Router\\AccessPoint');
        $route1->expects($this->any())
            ->method('doesRequestMatch')
            ->will($this->returnValue(true));
        $route1->expects($this->any())
            ->method('getCallback')
            ->will($this->returnValue(function() {
                return 'baz';
            }));

        $route2 = $this->getMock('\\Commentar\\Router\\AccessPoint');
        $route2->expects($this->any())
            ->method('doesRequestMatch')
            ->will($this->returnValue(false));

        $routeFactory = $this->getMock('\\Commentar\\Router\\RouteBuilder');
        $routeFactory->expects($this->at(0))
            ->method('build')
            ->will($this->returnValue($route1));
        $routeFactory->expects($this->at(1))
            ->method('build')
            ->will($this->returnValue($route2));

        $router = new Router($routeFactory);

        $this->assertNull($router->get('foo', '#/bar$#', function() {
            return 'baz';
        }));

        $this->assertNull($router->get('foo2', '#/bars$#', function() {
            return 'baz2';
        }));

        $request = $this->getMock('\\Commentar\\Http\\RequestData');
        $request->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue('GET'));

        $route = $router->getRouteByRequest($request);
        $callback = $route->getCallback();

        $this->assertInstanceOf('\\Commentar\\Router\\AccessPoint', $route);
        $this->assertSame('baz', $callback());
    }

    /**
     * @covers Commentar\Router\Router::__construct
     * @covers Commentar\Router\Router::get
     * @covers Commentar\Router\Router::addRoute
     * @covers Commentar\Router\Router::getRouteByRequest
     */
    public function testGetRouteByRequestMatchesLatter()
    {
        $route1 = $this->getMock('\\Commentar\\Router\\AccessPoint');
        $route1->expects($this->any())
            ->method('doesRequestMatch')
            ->will($this->returnValue(false));

        $route2 = $this->getMock('\\Commentar\\Router\\AccessPoint');
        $route2->expects($this->any())
            ->method('doesRequestMatch')
            ->will($this->returnValue(true));
        $route2->expects($this->any())
            ->method('getCallback')
            ->will($this->returnValue(function() {
                return 'baz2';
            }));

        $routeFactory = $this->getMock('\\Commentar\\Router\\RouteBuilder');
        $routeFactory->expects($this->at(0))
            ->method('build')
            ->will($this->returnValue($route1));
        $routeFactory->expects($this->at(1))
            ->method('build')
            ->will($this->returnValue($route2));

        $router = new Router($routeFactory);

        $this->assertNull($router->get('foo', '#/bar$#', function() {
            return 'baz';
        }));

        $this->assertNull($router->get('foo2', '#/bars$#', function() {
            return 'baz2';
        }));

        $request = $this->getMock('\\Commentar\\Http\\RequestData');
        $request->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue('GET'));

        $route = $router->getRouteByRequest($request);
        $callback = $route->getCallback();

        $this->assertInstanceOf('\\Commentar\\Router\\AccessPoint', $route);
        $this->assertSame('baz2', $callback());
    }

    /**
     * @covers Commentar\Router\Router::__construct
     * @covers Commentar\Router\Router::getRouteByRequest
     */
    public function testGetRouteByRequestNoMatchNotFoundRoute()
    {
        $notFoundRoute = $this->getMock('\\Commentar\\Router\\AccessPoint');
        $notFoundRoute->expects($this->any())
            ->method('doesRequestMatch')
            ->will($this->returnValue(false));
        $notFoundRoute->expects($this->any())
            ->method('getCallback')
            ->will($this->returnValue(function() {
                return '404';
            }));

        $routeFactory = $this->getMock('\\Commentar\\Router\\RouteBuilder');
        $routeFactory->expects($this->once())
            ->method('build')
            ->will($this->returnValue($notFoundRoute));

        $router = new Router($routeFactory);

        $this->assertNull($router->get('404', '#doesnotmatch#', function() {
            return '404';
        }));

        $request = $this->getMock('\\Commentar\\Http\\RequestData');
        $request->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue('GET'));

        $route = $router->getRouteByRequest($request);
        $callback = $route->getCallback();

        $this->assertInstanceOf('\\Commentar\\Router\\AccessPoint', $route);
        $this->assertSame('404', $callback());
    }

    /**
     * @covers Commentar\Router\Router::__construct
     * @covers Commentar\Router\Router::getRouteByRequest
     */
    public function testGetRouteByRequestNoMatchThrowsException()
    {
        $router = new Router($this->getMock('\\Commentar\\Router\\RouteBuilder'));

        $request = $this->getMock('\\Commentar\\Http\\RequestData');
        $request->expects($this->any())->method('getMethod')->will($this->returnValue('GET'));

        $this->setExpectedException('\\Commentar\\Router\\NoMatchingRouteException');

        $route = $router->getRouteByRequest($request);
    }
}
