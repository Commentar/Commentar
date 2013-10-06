<?php

namespace CommentarTest\Presentation\View;

use Commentar\Presentation\View\ConfirmDelete;

class ConfirmDeleteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Presentation\View\ConfirmDelete::__construct
     */
    public function testConstructCorrectAbstractInstance()
    {
        $view = new ConfirmDelete(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\View', $view);
    }

    /**
     * @covers Commentar\Presentation\View\ConfirmDelete::__construct
     */
    public function testConstructCorrectInstance()
    {
        $view = new ConfirmDelete(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\ConfirmDelete', $view);
    }

    /**
     * @covers Commentar\Presentation\View\ConfirmDelete::__construct
     * @covers Commentar\Presentation\View\ConfirmDelete::renderTemplate
     */
    public function testRenderTemplate()
    {
        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../../Mocks/themes/bar/page.phtml'));

        $view = new ConfirmDelete(
            $theme,
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
        );

        $this->assertSame('bartheme', $view->renderTemplate());
    }
}
