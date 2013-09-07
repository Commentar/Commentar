<?php

namespace CommentarTest\ServiceBuilder;

use Commentar\ServiceBuilder\Factory;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testConstructCorrectInterface()
    {
        $factory = new Factory();

        $this->assertInstanceOf('\\Commentar\\ServiceBuilder\\Builder', $factory);
    }

    /**
     *
     */
    public function testConstructCorrectInstance()
    {
        $factory = new Factory();

        $this->assertInstanceOf('\\Commentar\\ServiceBuilder\\Factory', $factory);
    }

    /**
     * @covers Commentar\ServiceBuilder\Factory::build
     */
    public function testBuildThrowsExceptionOnInvalidService()
    {
        $factory = new Factory();

        $this->setExpectedException('\\Commentar\\ServiceBuilder\\InvalidServiceException');

        $factory->build('\\Some\\Invalid\\Service\\ewydiyb4idyewibdcueyw\\Service');
    }

    /**
     * @covers Commentar\ServiceBuilder\Factory::build
     */
    public function testBuildWithoutArguments()
    {
        $factory = new Factory();

        $service = $factory->build('\\CommentarTest\\Mocks\\Service\\WithoutArguments');

        $this->assertInstanceOf('\\CommentarTest\\Mocks\\Service\\WithoutArguments', $service);
        $this->assertTrue($service->test());
    }

    /**
     * @covers Commentar\ServiceBuilder\Factory::build
     */
    public function testBuildWithArguments()
    {
        $factory = new Factory();

        $service = $factory->build('\\CommentarTest\\Mocks\\Service\\WithArguments', [true]);

        $this->assertInstanceOf('\\CommentarTest\\Mocks\\Service\\WithArguments', $service);
        $this->assertTrue($service->test());
    }
}
