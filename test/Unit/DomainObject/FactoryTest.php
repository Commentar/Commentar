<?php

namespace CommentarTest\Unit\DomainObject;

use Commentar\DomainObject\Factory;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\DomainObject\Factory::__construct
     */
    public function testConstructCorrectInterface()
    {
        $factory = new Factory();

        $this->assertInstanceOf('\\Commentar\\DomainObject\\Builder', $factory);
    }

    /**
     * @covers Commentar\DomainObject\Factory::__construct
     */
    public function testConstructCorrectInstance()
    {
        $factory = new Factory();

        $this->assertInstanceOf('\\Commentar\\DomainObject\\Factory', $factory);
    }

    /**
     * @covers Commentar\DomainObject\Factory::build
     */
    public function testBuildDefaultNamespace()
    {
        $factory = new Factory();

        $this->assertInstanceOf('\\Commentar\\DomainObject\\User', $factory->build('User'));
    }

    /**
     * @covers Commentar\DomainObject\Factory::build
     */
    public function testBuildCustomNamespace()
    {
        $factory = new Factory('\\CommentarTest\\Mocks\\DomainObject');

        $this->assertInstanceOf('\\CommentarTest\\Mocks\\DomainObject\\Mock', $factory->build('Mock'));
    }
}
