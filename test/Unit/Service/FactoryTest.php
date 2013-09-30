<?php

namespace CommentarTest\Unit\Service;

use Commentar\Service\Factory;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Service\Factory::__construct
     */
    public function testConstructCorrectInterface()
    {
        $factory = new Factory(
            $this->getMock('\\Commentar\\DomainObject\\Builder'),
            $this->getMock('\\Commentar\\Storage\\Datamapper\\Builder')
        );

        $this->assertInstanceOf('\\Commentar\\Service\\Builder', $factory);
    }

    /**
     * @covers Commentar\Service\Factory::__construct
     */
    public function testConstructCorrectInstance()
    {
        $factory = new Factory(
            $this->getMock('\\Commentar\\DomainObject\\Builder'),
            $this->getMock('\\Commentar\\Storage\\Datamapper\\Builder')
        );

        $this->assertInstanceOf('\\Commentar\\Service\\Factory', $factory);
    }

    /**
     * @covers Commentar\Service\Factory::__construct
     * @covers Commentar\Service\Factory::build
     */
    public function testBuildThrowsUpOnInvalidService()
    {
        $factory = new Factory(
            $this->getMock('\\Commentar\\DomainObject\\Builder'),
            $this->getMock('\\Commentar\\Storage\\Datamapper\\Builder')
        );

        $this->setExpectedException('\\Commentar\\ServiceBuilder\\InvalidServiceException');

        $factory->build('\\NonExistentService');
    }

    /**
     * @covers Commentar\Service\Factory::__construct
     * @covers Commentar\Service\Factory::build
     */
    public function testBuildServiceFromDefaultNamespace()
    {
        $factory = new Factory(
            $this->getMock('\\Commentar\\DomainObject\\Builder'),
            $this->getMock('\\Commentar\\Storage\\Datamapper\\Builder')
        );

        $this->assertInstanceOf('\\Commentar\\Service\\User', $factory->build('User'));
    }

    /**
     * @covers Commentar\Service\Factory::__construct
     * @covers Commentar\Service\Factory::build
     */
    public function testBuildCustomService()
    {
        $factory = new Factory(
            $this->getMock('\\Commentar\\DomainObject\\Builder'),
            $this->getMock('\\Commentar\\Storage\\Datamapper\\Builder')
        );

        $this->assertInstanceOf(
            '\\CommentarTest\Mocks\Service\\Mock',
            $factory->build('\\CommentarTest\Mocks\Service\\Mock')
        );
    }
}
