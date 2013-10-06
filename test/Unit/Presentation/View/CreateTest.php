<?php

namespace CommentarTest\Presentation\View;

use Commentar\Presentation\View\Create;

class CreateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Presentation\View\Create::__construct
     */
    public function testConstructCorrectAbstractInstance()
    {
        $view = new Create(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\View', $view);
    }

    /**
     * @covers Commentar\Presentation\View\Create::__construct
     */
    public function testConstructCorrectInstance()
    {
        $view = new Create(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\Create', $view);
    }

    /**
     * @covers Commentar\Presentation\View\Create::__construct
     * @covers Commentar\Presentation\View\Create::renderTemplate
     */
    public function testRenderTemplate()
    {
        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../../Mocks/themes/bar/page.phtml'));

        $view = new Create(
            $theme,
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
        );

        $this->assertSame('bartheme', $view->renderTemplate());
    }
}
