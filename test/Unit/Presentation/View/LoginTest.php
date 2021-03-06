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
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
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
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
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

        $view = new Login(
            $theme,
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
        );

        $this->assertSame('bartheme', $view->renderTemplate());
    }

    /**
     * @covers Commentar\Presentation\View\Login::__construct
     * @covers Commentar\Presentation\View\Login::renderTemplate
     */
    public function testRenderTemplateCorrectReturnUrlFilled()
    {
        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../../Mocks/themes/bar/page.phtml'));

        $view = new Login(
            $theme,
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator'),
            ['returnUrl' => 'http://pieterhordijk.com']
        );
        $view->renderTemplate();

        $this->assertSame('http://pieterhordijk.com', $view->returnUrl);
    }

    /**
     * @covers Commentar\Presentation\View\Login::__construct
     * @covers Commentar\Presentation\View\Login::renderTemplate
     */
    public function testRenderTemplateCorrectReturnUrlEmpty()
    {
        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../../Mocks/themes/bar/page.phtml'));

        $view = new Login(
            $theme,
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
        );
        $view->renderTemplate();

        $this->assertSame('/', $view->returnUrl);
    }

    /**
     * @covers Commentar\Presentation\View\Login::__construct
     * @covers Commentar\Presentation\View\Login::renderTemplate
     */
    public function testRenderTemplateCorrectUsernameFilled()
    {
        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../../Mocks/themes/bar/page.phtml'));

        $view = new Login(
            $theme,
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator'),
            ['username' => 'PeeHaa']
        );
        $view->renderTemplate();

        $this->assertSame('PeeHaa', $view->username);
    }

    /**
     * @covers Commentar\Presentation\View\Login::__construct
     * @covers Commentar\Presentation\View\Login::renderTemplate
     */
    public function testRenderTemplateCorrectUsernameEmpty()
    {
        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../../Mocks/themes/bar/page.phtml'));

        $view = new Login(
            $theme,
            $this->getMock('\\Commentar\\ServiceBuilder\\Builder'),
            $this->getMock('\\Commentar\\Auth\\Authenticator')
        );
        $view->renderTemplate();

        $this->assertSame('', $view->username);
    }
}
