<?php

namespace CommentarTest\Unit\Security\Generator;

use Commentar\Security\Generator\OpenSsl;

class OpenSslTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Security\Generator\OpenSsl::__construct
     */
    public function testConstructCorrectInterface()
    {
        $generator = new OpenSsl();

        $this->assertInstanceOf('\\Commentar\\Security\\Generator', $generator);
    }

    /**
     * @covers Commentar\Security\Generator\OpenSsl::__construct
     */
    public function testConstructCorrectInstance()
    {
        $generator = new OpenSsl();

        $this->assertInstanceOf('\\Commentar\\Security\\Generator\\OpenSsl', $generator);
    }

    /**
     * @covers Commentar\Security\Generator\OpenSsl::__construct
     * @covers Commentar\Security\Generator\OpenSsl::generate
     */
    public function testGenerate()
    {
        $generator = new OpenSsl();

        $this->assertSame(128, strlen($generator->generate(128)));
    }

    /**
     * @covers Commentar\Security\Generator\OpenSsl::__construct
     * @covers Commentar\Security\Generator\OpenSsl::generate
     */
    public function testGenerateRandomTheStupidWay()
    {
        $generator = new OpenSsl();

        $strings = [];
        for ($i = 0; $i < 10; $i++) {
            $strings[] = $generator->generate(56);
        }

        $this->assertSame($strings, array_unique($strings));
    }
}
