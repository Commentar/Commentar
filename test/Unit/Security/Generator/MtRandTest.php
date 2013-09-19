<?php

namespace CommentarTest\Unit\Security\Generator;

use Commentar\Security\Generator\MtRand;

class MtRandTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testConstructCorrectInterface()
    {
        $generator = new MtRand();

        $this->assertInstanceOf('\\Commentar\\Security\\Generator', $generator);
    }

    /**
     *
     */
    public function testConstructCorrectInstance()
    {
        $generator = new MtRand();

        $this->assertInstanceOf('\\Commentar\\Security\\Generator\\MtRand', $generator);
    }

    /**
     * @covers Commentar\Security\Generator\MtRand::generate
     */
    public function testGenerate()
    {
        $generator = new MtRand();

        $this->assertSame(128, strlen($generator->generate(128)));
    }

    /**
     * @covers Commentar\Security\Generator\MtRand::generate
     */
    public function testGenerateRandomTheStupidWay()
    {
        $generator = new MtRand();

        $strings = [];
        for ($i = 0; $i < 10; $i++) {
            $strings[] = $generator->generate(56);
        }

        $this->assertSame($strings, array_unique($strings));
    }
}
