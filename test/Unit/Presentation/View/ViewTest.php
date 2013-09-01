<?php

namespace CommentarTest\Presentation\View;

use Commentar\Presentation\View\View;

class ViewTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Presentation\View\View::__construct
     */
    public function testConstructCorrectAbstractInstance()
    {
        $view = $this->getMockForAbstractClass(
            '\\Commentar\\Presentation\\View\\View',
            [$this->getMock('\\Commentar\\Presentation\\ThemeLoader')]
        );

        $view->expects($this->any())
             ->method('renderTemplate')
             ->will($this->returnValue('rendered template'));

        $this->assertInstanceOf('\\Commentar\\Presentation\\View\\View', $view);
    }

    /**
     * @covers Commentar\Presentation\View\View::__construct
     * @covers Commentar\Presentation\View\View::renderPage
     * @covers Commentar\Presentation\View\View::renderTemplate
     * @covers Commentar\Presentation\View\View::getContent
     */
    public function testRenderPage()
    {
        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../../Mocks/themes/bar/page.phtml'));

        $view = $this->getMockForAbstractClass(
            '\\Commentar\\Presentation\\View\\View',
            [$theme]
        );

        $view->expects($this->any())
             ->method('renderTemplate')
             ->will($this->returnValue('rendered template'));

        $this->assertSame('bartheme', $view->renderPage());
    }

    /**
     * @covers Commentar\Presentation\View\View::__construct
     * @covers Commentar\Presentation\View\View::renderView
     * @covers Commentar\Presentation\View\View::getFullyQualifiedViewName
     */
    public function testRenderView()
    {
        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../../Mocks/themes/bar/page.phtml'));

        $view = $this->getMockForAbstractClass(
            '\\Commentar\\Presentation\\View\\View',
            [$theme]
        );
    }

    /**
     * @covers Commentar\Presentation\View\View::__construct
     * @covers Commentar\Presentation\View\View::__set
     */
    public function testSet()
    {
        $view = $this->getMockForAbstractClass(
            '\\Commentar\\Presentation\\View\\View',
            [$this->getMock('\\Commentar\\Presentation\\ThemeLoader')]
        );

        $view->expects($this->any())
             ->method('renderTemplate')
             ->will($this->returnValue('rendered template'));

        $view->key = 'value';
    }

    /**
     * @covers Commentar\Presentation\View\View::__construct
     * @covers Commentar\Presentation\View\View::__set
     * @covers Commentar\Presentation\View\View::__get
     */
    public function testGet()
    {
        $view = $this->getMockForAbstractClass(
            '\\Commentar\\Presentation\\View\\View',
            [$this->getMock('\\Commentar\\Presentation\\ThemeLoader')]
        );

        $view->expects($this->any())
             ->method('renderTemplate')
             ->will($this->returnValue('rendered template'));

        $view->key = 'value';

        $this->assertSame('value', $view->key);
    }

    /**
     * @covers Commentar\Presentation\View\View::__construct
     * @covers Commentar\Presentation\View\View::__get
     */
    public function testGetThrowsUp()
    {
        $view = $this->getMockForAbstractClass(
            '\\Commentar\\Presentation\\View\\View',
            [$this->getMock('\\Commentar\\Presentation\\ThemeLoader')]
        );

        $view->expects($this->any())
             ->method('renderTemplate')
             ->will($this->returnValue('rendered template'));

        $this->setExpectedException('\\Commentar\\Presentation\\View\\InvalidViewVariableException');

        $view->key;
    }
}
