<?php

namespace CommentarTest\Unit\Security\Generator;

use Commentar\Security\Generator\Mcrypt;

class McryptTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Security\Generator\Mcrypt::__construct
     */
    public function testConstructCorrectInterface()
    {
        $generator = new Mcrypt();

        $this->assertInstanceOf('\\Commentar\\Security\\Generator', $generator);
    }

    /**
     * @covers Commentar\Security\Generator\Mcrypt::__construct
     */
    public function testConstructCorrectInstance()
    {
        $generator = new Mcrypt();

        $this->assertInstanceOf('\\Commentar\\Security\\Generator\\Mcrypt', $generator);
    }

    /**
     * @covers Commentar\Security\Generator\Mcrypt::__construct
     * @covers Commentar\Security\Generator\Mcrypt::generate
     */
    public function testGenerate()
    {
        $generator = new Mcrypt();

        $this->assertSame(128, strlen($generator->generate(128)));
    }

    /**
     * @covers Commentar\Security\Generator\Mcrypt::__construct
     * @covers Commentar\Security\Generator\Mcrypt::generate
     */
    public function testGenerateRandomTheStupidWay()
    {
        $generator = new Mcrypt();

        $strings = [];
        for ($i = 0; $i < 10; $i++) {
            $strings[] = $generator->generate(56);
        }

        $this->assertSame($strings, array_unique($strings));
    }
}
