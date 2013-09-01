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
     */
    public function testDispatch()
    {
        $route = $this->getMock('\\Commentar\\Router\\AccessPoint');
        $route->expects($this->any())
            ->method('getCallback')
            ->will($this->returnValue(function($request) {
                return 'foo';
            }));

        $router = $this->getMock('\\Commentar\\Router\\Routable');
        $router->expects($this->any())
            ->method('getRouteByRequest')
            ->will($this->returnValue($route));

        $response = $this->getMock('\\Commentar\\Http\\ResponseData');
        $response->expects($this->any())
            ->method('setBody')
            ->will($this->returnCallback(function ($body) {
                \PHPUnit_Framework_Assert::assertSame('foo', $body);
            }));

        $frontcontroller = new FrontController(
            $this->getMock('\\Commentar\\Http\\RequestData'),
            $response,
            $router
        );

        $this->assertNull($frontcontroller->dispatch());
    }
}
