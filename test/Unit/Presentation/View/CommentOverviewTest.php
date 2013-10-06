<?php

namespace CommentarTest\Presentation\View;

use Commentar\Presentation\View\CommentOverview;

class CommentOverviewTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Presentation\View\CommentOverview::__construct
     */
    public function testConstructCorrectAbstractInstance()
    {
        $view = new CommentOverview(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\View', $view);
    }

    /**
     * @covers Commentar\Presentation\View\CommentOverview::__construct
     */
    public function testConstructCorrectInstance()
    {
        $view = new CommentOverview(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\CommentOverview', $view);
    }

    /**
     * @covers Commentar\Presentation\View\CommentOverview::__construct
     * @covers Commentar\Presentation\View\CommentOverview::renderTemplate
     */
    public function testRenderTemplate()
    {
        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../../Mocks/themes/bar/page.phtml'));

        $view = new CommentOverview(
            $theme,
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
        );

        $this->assertSame('bartheme', $view->renderTemplate());
    }
}
