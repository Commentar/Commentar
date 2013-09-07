<?php

namespace CommentarTest\Presentation\View;

use Commentar\Presentation\View\NotFound;

class NotFoundTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Presentation\View\NotFound::__construct
     */
    public function testConstructCorrectAbstractInstance()
    {
        $view = new NotFound(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\View', $view);
    }

    /**
     * @covers Commentar\Presentation\View\NotFound::__construct
     */
    public function testConstructCorrectInstance()
    {
        $view = new NotFound(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\NotFound', $view);
    }

    /**
     * @covers Commentar\Presentation\View\NotFound::__construct
     * @covers Commentar\Presentation\View\NotFound::renderTemplate
     */
    public function testRenderTemplate()
    {
        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../../Mocks/themes/bar/page.phtml'));

        $view = new NotFound($theme, $this->getMock('\\Commentar\\ServiceBuilder\\Builder'));

        $this->assertSame('bartheme', $view->renderTemplate());
    }
}
