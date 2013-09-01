<?php

namespace CommentarTest\Router;

use Commentar\Router\RouteFactory;

class RouteFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testConstructCorrectInterface()
    {
        $routeFactory = new RouteFactory();

        $this->assertInstanceOf('\\Commentar\\Router\\RouteBuilder', $routeFactory);
    }

    /**
     *
     */
    public function testConstructCorrectInstance()
    {
        $routeFactory = new RouteFactory();

        $this->assertInstanceOf('\\Commentar\\Router\\RouteFactory', $routeFactory);
    }

    /**
     * @covers Commentar\Router\RouteFactory::build
     */
    public function testBuild()
    {
        $routeFactory = new RouteFactory();

        $route = $routeFactory->build('foo', '#/bar#', 'get', function() {
            return 'baz';
        });

        $this->assertInstanceOf('\\Commentar\\Router\\AccessPoint', $route);
        $this->assertInstanceOf('\\Commentar\\Router\\Route', $route);
    }
}
