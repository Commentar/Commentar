<?php

namespace CommentarTest\Unit\Core;

use Commentar\Core\Autoloader;

class AutoloaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Core\Autoloader::__construct
     */
    public function testConstructCorrectInstance()
    {
        $autoloader = new Autoloader('Test', '/');

        $this->assertInstanceOf('\\Commentar\\Core\\Autoloader', $autoloader);
    }

    /**
     * @covers Commentar\Core\Autoloader::__construct
     * @covers Commentar\Core\Autoloader::register
     */
    public function testRegister()
    {
        $autoloader = new Autoloader('Test', '/');

        $this->assertTrue($autoloader->register());
    }

    /**
     * @covers Commentar\Core\Autoloader::__construct
     * @covers Commentar\Core\Autoloader::register
     * @covers Commentar\Core\Autoloader::unregister
     */
    public function testUnregister()
    {
        $autoloader = new Autoloader('Test', '/');

        $this->assertTrue($autoloader->register());
        $this->assertTrue($autoloader->unregister());
    }

    /**
     * @covers Commentar\Core\Autoloader::__construct
     * @covers Commentar\Core\Autoloader::register
     * @covers Commentar\Core\Autoloader::load
     */
    public function testLoadSuccess()
    {
        $autoloader = new Autoloader('FakeProject', dirname(__DIR__) . '/../Mocks/Core');

        $this->assertTrue($autoloader->register());

        $someClass = new \FakeProject\NS\SomeClass();

        $this->assertTrue($someClass->isLoaded());
    }

    /**
     * @covers Commentar\Core\Autoloader::__construct
     * @covers Commentar\Core\Autoloader::register
     * @covers Commentar\Core\Autoloader::load
     */
    public function testLoadSuccessExtraSlashedNamespace()
    {
        $autoloader = new Autoloader('\\\\FakeProject', dirname(__DIR__) . '/../Mocks/Core');

        $this->assertTrue($autoloader->register());

        $someClass = new \FakeProject\NS\SomeClass();

        $this->assertTrue($someClass->isLoaded());
    }

    /**
     * @covers Commentar\Core\Autoloader::__construct
     * @covers Commentar\Core\Autoloader::register
     * @covers Commentar\Core\Autoloader::load
     */
    public function testLoadSuccessExtraForwardSlashedPath()
    {
        $autoloader = new Autoloader('FakeProject', dirname(__DIR__) . '/../Mocks/Core//');

        $this->assertTrue($autoloader->register());

        $someClass = new \FakeProject\NS\SomeClass();

        $this->assertTrue($someClass->isLoaded());
    }

    /**
     * @covers Commentar\Core\Autoloader::__construct
     * @covers Commentar\Core\Autoloader::register
     * @covers Commentar\Core\Autoloader::load
     */
    public function testLoadSuccessExtraBackwardSlashedPath()
    {
        $autoloader = new Autoloader('FakeProject', dirname(__DIR__) . '/../Mocks/Core\\');

        $this->assertTrue($autoloader->register());

        $someClass = new \FakeProject\NS\SomeClass();

        $this->assertTrue($someClass->isLoaded());
    }

    /**
     * @covers Commentar\Core\Autoloader::__construct
     * @covers Commentar\Core\Autoloader::register
     * @covers Commentar\Core\Autoloader::load
     */
    public function testLoadSuccessExtraMixedSlashedPath()
    {
        $autoloader = new Autoloader('FakeProject', dirname(__DIR__) . '/../Mocks/Core\\\\/\\//');

        $this->assertTrue($autoloader->register());

        $someClass = new \FakeProject\NS\SomeClass();

        $this->assertTrue($someClass->isLoaded());
    }

    /**
     * @covers Commentar\Core\Autoloader::__construct
     * @covers Commentar\Core\Autoloader::register
     * @covers Commentar\Core\Autoloader::load
     */
    public function testLoadUnknownClass()
    {
        $autoloader = new Autoloader('FakeProject', dirname(__DIR__) . '/../Mocks/Core\\\\/\\//');

        $this->assertTrue($autoloader->register());

        $this->assertFalse($autoloader->load('IDontExistClass'));
    }
}
