<?php

namespace CommentarTest\Unit\Presentation\View;

use Commentar\Presentation\View\Factory;

//use Commentar\Presentation\ThemeLoader;
//use Commentar\ServiceBuilder\Builder as ServiceBuilder;

class FactoryTest extends \PHPUnit_Framework_TestCase// implements Builder
{
    /**
     * @covers Commentar\Presentation\View\Factory::__construct
     */
    public function testConstructCorrectAbstractInstance()
    {
        $factory = new Factory(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\Builder', $factory);
    }

    /**
     * @covers Commentar\Presentation\View\Factory::__construct
     */
    public function testConstructCorrectInstance()
    {
        $factory = new Factory(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\Factory', $factory);
    }

    /**
     * @covers Commentar\Presentation\View\Factory::__construct
     * @covers Commentar\Presentation\View\Factory::build
     */
    public function testBuildCommentarNamespace()
    {
        $factory = new Factory(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\View', $factory->build('NotFound'));
        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\NotFound', $factory->build('NotFound'));
    }

    /**
     * @covers Commentar\Presentation\View\Factory::__construct
     * @covers Commentar\Presentation\View\Factory::build
     */
    public function testBuildCustomNamespace()
    {
        $factory = new Factory(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder')
        );

        $this->assertInstanceOf(
            '\\Commentar\\Presentation\\View\\View',
            $factory->build('\\CommentarTest\\Mocks\\Presentation\\View\\Mock')
        );

        $this->assertInstanceOf(
            '\\CommentarTest\\Mocks\\Presentation\\View\\Mock',
            $factory->build('\\CommentarTest\\Mocks\\Presentation\\View\\Mock')
        );
    }

    /**
     * @covers Commentar\Presentation\View\Factory::__construct
     * @covers Commentar\Presentation\View\Factory::build
     */
    public function testBuildThrowsUpOnInvalidView()
    {
        $this->setExpectedException('\\Commentar\\Presentation\\View\\InvalidViewException');

        $factory = new Factory(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder')
        );

        $factory->build('\\CommentarTest\\Mocks\\Presentation\\View\\NotExistingViewClassThingy');
    }
}
