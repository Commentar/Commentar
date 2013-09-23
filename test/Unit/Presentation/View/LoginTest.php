<?php

namespace CommentarTest\Presentation\View;

use Commentar\Presentation\View\Login;

class LoginTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Presentation\View\Login::__construct
     */
    public function testConstructCorrectAbstractInstance()
    {
        $view = new Login(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\View', $view);
    }

    /**
     * @covers Commentar\Presentation\View\Login::__construct
     */
    public function testConstructCorrectInstance()
    {
        $view = new Login(
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader'),
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\Login', $view);
    }

    /**
     * @covers Commentar\Presentation\View\Login::__construct
     * @covers Commentar\Presentation\View\Login::renderTemplate
     */
    public function testRenderTemplate()
    {
        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../../Mocks/themes/bar/page.phtml'));

        $view = new Login($theme, $this->getMock('\\Commentar\\ServiceBuilder\\Builder'));

        $this->assertSame('bartheme', $view->renderTemplate());
    }
}
