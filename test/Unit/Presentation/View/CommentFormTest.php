<?php

namespace CommentarTest\Presentation\View;

use Commentar\Presentation\View\CommentForm;

class CommentFormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Presentation\View\CommentForm::__construct
     */
    public function testConstructCorrectAbstractInstance()
    {
        $view = new CommentForm(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\View', $view);
    }

    /**
     * @covers Commentar\Presentation\View\CommentForm::__construct
     */
    public function testConstructCorrectInstance()
    {
        $view = new CommentForm(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\CommentForm', $view);
    }

    /**
     * @covers Commentar\Presentation\View\CommentForm::__construct
     * @covers Commentar\Presentation\View\CommentForm::renderTemplate
     */
    public function testRenderTemplate()
    {
        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../../Mocks/themes/bar/page.phtml'));

        $view = new CommentForm($theme, $this->getMock('\\Commentar\\ServiceBuilder\\Builder'));

        $this->assertSame('bartheme', $view->renderTemplate());
    }
}
