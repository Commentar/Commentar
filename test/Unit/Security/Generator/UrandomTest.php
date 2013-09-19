<?php

namespace CommentarTest\Unit\Security\Generator;

use Commentar\Security\Generator\Urandom;

class UrandomTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Security\Generator\Urandom::__construct
     */
    public function testConstructCorrectInterface()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $this->setExpectedException('\\Commentar\\Security\Generator\\UnsupportedAlgorithmException');
        }

        $generator = new Urandom();

        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            $this->assertInstanceOf('\\Commentar\\Security\\Generator', $generator);
        }
    }

    /**
     * @covers Commentar\Security\Generator\Urandom::__construct
     */
    public function testConstructCorrectInstance()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $this->setExpectedException('\\Commentar\\Security\Generator\\UnsupportedAlgorithmException');
        }

        $generator = new Urandom();

        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            $this->assertInstanceOf('\\Commentar\\Security\\Generator\\Urandom', $generator);
        }
    }

    /**
     * @covers Commentar\Security\Generator\Urandom::__construct
     * @covers Commentar\Security\Generator\Urandom::generate
     */
    public function testGenerate()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $this->setExpectedException('\\Commentar\\Security\Generator\\UnsupportedAlgorithmException');
        }

        $generator = new Urandom();

        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            $this->assertSame(128, strlen($generator->generate(128)));
        }
    }

    /**
     * @covers Commentar\Security\Generator\Urandom::__construct
     * @covers Commentar\Security\Generator\Urandom::generate
     */
    public function testGenerateRandomTheStupidWay()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $this->setExpectedException('\\Commentar\\Security\Generator\\UnsupportedAlgorithmException');
        }

        $generator = new Urandom();

        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            $strings = [];
            for ($i = 0; $i < 10; $i++) {
                $strings[] = $generator->generate(56);
            }

            $this->assertSame($strings, array_unique($strings));
        }
    }
}
