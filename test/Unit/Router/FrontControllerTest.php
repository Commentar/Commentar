<?php

namespace CommentarTest\Router;

use Commentar\Router\FrontController;

class FrontControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Router\FrontController::__construct
     */
    public function testConstructCorrectInstance()
    {
        $frontcontroller = new FrontController(
            $this->getMock('\\Commentar\\Http\\RequestData'),
            $this->getMock('\\Commentar\\Http\\ResponseData'),
            $this->getMock('\\Commentar\\Router\\Routable')
        );

        $this->assertInstanceOf('\\Commentar\\Router\\FrontController', $frontcontroller);
    }

    /**
     * @covers Commentar\Router\FrontController::__construct
     * @covers Commentar\Router\FrontController::dispatch
     * @covers Commentar\Router\FrontController::setParameters
     */
    public function testDispatchWithoutParams()
    {
        $route = $this->getMock('\\Commentar\\Router\\AccessPoint');
        $route->expects($this->any())
            ->method('getCallback')
            ->will($this->returnValue(function($request) {
                return 'foo';
            }));
        $route->expects($this->any())
            ->method('getPath')
            ->will($this->returnValue('/foo/'));

        $router = $this->getMock('\\Commentar\\Router\\Routable');
        $router->expects($this->any())
            ->method('getRouteByRequest')
            ->will($this->returnValue($route));

        $request = $this->getMock('\\Commentar\\Http\\RequestData');
        $request->expects($this->any())
            ->method('setParameters')
            ->will($this->returnCallback(function ($params) {
                \PHPUnit_Framework_Assert::assertSame([], $params);
            }));

        $response = $this->getMock('\\Commentar\\Http\\ResponseData');
        $response->expects($this->any())
            ->method('setBody')
            ->will($this->returnCallback(function ($body) {
                \PHPUnit_Framework_Assert::assertSame('foo', $body);
            }));

        $frontcontroller = new FrontController(
            $request,
            $response,
            $router
        );

        $this->assertNull($frontcontroller->dispatch());
    }

    /**
     * @covers Commentar\Router\FrontController::__construct
     * @covers Commentar\Router\FrontController::dispatch
     * @covers Commentar\Router\FrontController::setParameters
     */
    public function testDispatchWithParams()
    {
        $route = $this->getMock('\\Commentar\\Router\\AccessPoint');
        $route->expects($this->any())
            ->method('getCallback')
            ->will($this->returnValue(function($request) {
                return 'foo';
            }));
        $route->expects($this->any())
            ->method('getPath')
            ->will($this->returnValue('/(foo)/'));

        $router = $this->getMock('\\Commentar\\Router\\Routable');
        $router->expects($this->any())
            ->method('getRouteByRequest')
            ->will($this->returnValue($route));

        $request = $this->getMock('\\Commentar\\Http\\RequestData');
        $request->expects($this->any())
            ->method('setParameters')
            ->will($this->returnCallback(function ($params) {
                \PHPUnit_Framework_Assert::assertSame(['foo'], $params);
            }));
        $request->expects($this->any())
            ->method('getPath')
            ->will($this->returnValue('/foo'));

        $response = $this->getMock('\\Commentar\\Http\\ResponseData');
        $response->expects($this->any())
            ->method('setBody')
            ->will($this->returnCallback(function ($body) {
                \PHPUnit_Framework_Assert::assertSame('foo', $body);
            }));

        $frontcontroller = new FrontController(
            $request,
            $response,
            $router
        );

        $this->assertNull($frontcontroller->dispatch());
    }
}
