<?php

namespace CommentarTest\Presentation\View;

use Commentar\Presentation\View\CommentList;

class CommentListTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Presentation\View\CommentList::__construct
     */
    public function testConstructCorrectAbstractInstance()
    {
        $view = new CommentList($this->getMock('\\Commentar\\Presentation\\ThemeLoader'));

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\View', $view);
    }

    /**
     * @covers Commentar\Presentation\View\CommentList::__construct
     */
    public function testConstructCorrectInstance()
    {
        $view = new CommentList($this->getMock('\\Commentar\\Presentation\\ThemeLoader'));

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\CommentList', $view);
    }

    /**
     * @covers Commentar\Presentation\View\CommentList::__construct
     * @covers Commentar\Presentation\View\CommentList::renderTemplate
     */
    public function testRenderTemplate()
    {
        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../../Mocks/themes/bar/page.phtml'));

        $view = new CommentList($theme);

        $this->assertSame('bartheme', $view->renderTemplate());
    }
}
