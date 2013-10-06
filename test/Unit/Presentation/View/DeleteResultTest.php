<?php

namespace CommentarTest\Presentation\View;

use Commentar\Presentation\View\DeleteResult;

class DeleteResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Presentation\View\DeleteResult::__construct
     */
    public function testConstructCorrectAbstractInstance()
    {
        $view = new DeleteResult(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\View', $view);
    }

    /**
     * @covers Commentar\Presentation\View\DeleteResult::__construct
     */
    public function testConstructCorrectInstance()
    {
        $view = new DeleteResult(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\DeleteResult', $view);
    }

    /**
     * @covers Commentar\Presentation\View\DeleteResult::__construct
     * @covers Commentar\Presentation\View\DeleteResult::renderTemplate
     */
    public function testRenderTemplate()
    {
        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../../Mocks/themes/bar/page.phtml'));

        $view = new DeleteResult(
            $theme,
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
        );

        $this->assertSame('bartheme', $view->renderTemplate());
    }
}
