<?php

namespace CommentarTest\Router;

use Commentar\Router\Route;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Router\Route::__construct
     */
    public function testConstructCorrectInterface()
    {
        $route = new Route('foo', '#/bar#', 'get', function() {
            return 'baz';
        });

        $this->assertInstanceOf('\\Commentar\\Router\\AccessPoint', $route);
    }

    /**
     * @covers Commentar\Router\Route::__construct
     */
    public function testConstructCorrectInstance()
    {
        $route = new Route('foo', '#/bar#', 'get', function() {
            return 'baz';
        });

        $this->assertInstanceOf('\\Commentar\\Router\\Route', $route);
    }

    /**
     * @covers Commentar\Router\Route::__construct
     * @covers Commentar\Router\Route::doesRequestMatch
     * @covers Commentar\Router\Route::doesMethodMatch
     */
    public function testDoesRequestMatchNoMethodMatch()
    {
        $route = new Route('foo', '#/bar#', 'get', function() {
            return 'baz';
        });

        $request = $this->getMock('\\Commentar\\Http\\RequestData');
        $request->expects($this->any())->method('getMethod')->will($this->returnValue('post'));

        $this->assertFalse($route->doesRequestMatch($request));
    }

    /**
     * @covers Commentar\Router\Route::__construct
     * @covers Commentar\Router\Route::doesRequestMatch
     * @covers Commentar\Router\Route::doesMethodMatch
     * @covers Commentar\Router\Route::doesPathMatch
     */
    public function testDoesRequestMatchNoPathMatch()
    {
        $route = new Route('foo', '#/bar#', 'get', function() {
            return 'baz';
        });

        $request = $this->getMock('\\Commentar\\Http\\RequestData');
        $request->expects($this->any())->method('getMethod')->will($this->returnValue('get'));
        $request->expects($this->any())->method('getPath')->will($this->returnValue('/baz'));

        $this->assertFalse($route->doesRequestMatch($request));
    }

    /**
     * @covers Commentar\Router\Route::__construct
     * @covers Commentar\Router\Route::doesRequestMatch
     * @covers Commentar\Router\Route::doesMethodMatch
     * @covers Commentar\Router\Route::doesPathMatch
     */
    public function testDoesRequestMatchMatchCorrectCase()
    {
        $route = new Route('foo', '#/bar#', 'get', function() {
            return 'baz';
        });

        $request = $this->getMock('\\Commentar\\Http\\RequestData');
        $request->expects($this->any())->method('getMethod')->will($this->returnValue('get'));
        $request->expects($this->any())->method('getPath')->will($this->returnValue('/bar'));

        $this->assertTrue($route->doesRequestMatch($request));
    }

    /**
     * @covers Commentar\Router\Route::__construct
     * @covers Commentar\Router\Route::doesRequestMatch
     * @covers Commentar\Router\Route::doesMethodMatch
     * @covers Commentar\Router\Route::doesPathMatch
     */
    public function testDoesRequestMatchMatchCaseInsensitive()
    {
        $route = new Route('foo', '#/bar#', 'get', function() {
            return 'baz';
        });

        $request = $this->getMock('\\Commentar\\Http\\RequestData');
        $request->expects($this->any())->method('getMethod')->will($this->returnValue('GET'));
        $request->expects($this->any())->method('getPath')->will($this->returnValue('/bar'));

        $this->assertTrue($route->doesRequestMatch($request));
    }

    /**
     * @covers Commentar\Router\Route::__construct
     * @covers Commentar\Router\Route::getPath
     */
    public function testGetPath()
    {
        $route = new Route('foo', '#/bar#', 'get', function() {
            return 'baz';
        });

        $this->assertSame('#/bar#', $route->getPath());
    }

    /**
     * @covers Commentar\Router\Route::__construct
     * @covers Commentar\Router\Route::getCallback
     */
    public function testGetCallback()
    {
        $route = new Route('foo', '#/bar#', 'get', function() {
            return 'baz';
        });

        $callback = $route->getCallback();

        $this->assertSame('baz', $callback());
    }
}
