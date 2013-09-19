<?php

namespace CommentarTest\Unit\Security\Generator;

use Commentar\Security\Generator\Factory;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testConstructCorrectInterface()
    {
        $factory = new Factory();

        $this->assertInstanceOf('\\Commentar\\Security\\Generator\\Builder', $factory);
    }

    /**
     *
     */
    public function testConstructCorrectInstance()
    {
        $factory = new Factory();

        $this->assertInstanceOf('\\Commentar\\Security\\Generator\\Factory', $factory);
    }

    /**
     * @covers Commentar\Security\Generator\Factory::build
     */
    public function testBuildFakeGeneratorSuccess()
    {
        $factory = new Factory();

        $this->assertInstanceOf(
            '\\Commentar\\Security\\Generator', $factory->build('\\CommentarTest\\Mocks\\Security\\Generator\\Fake')
        );
    }

    /**
     * @covers Commentar\Security\Generator\Factory::build
     */
    public function testBuildUnknownGeneratorFail()
    {
        $factory = new Factory();

        $this->setExpectedException('\\Commentar\\Security\\Generator\\InvalidGeneratorException');

        $factory->build('\\CommentarUnknown\\UnknownGenerator');
    }
}
