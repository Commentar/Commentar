<?php

namespace CommentarTest\Presentation;

use Commentar\Presentation\Theme;

class ThemeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Presentation\Theme::__construct
     */
    public function testConstructCorrectInterface()
    {
        $theme = new Theme(__DIR__);

        $this->assertInstanceOf('\\Commentar\\Presentation\\ThemeLoader', $theme);
    }

    /**
     * @covers Commentar\Presentation\Theme::__construct
     */
    public function testConstructCorrectInstance()
    {
        $theme = new Theme(__DIR__);

        $this->assertInstanceOf('\\Commentar\\Presentation\\Theme', $theme);
    }

    /**
     * @covers Commentar\Presentation\Theme::__construct
     * @covers Commentar\Presentation\Theme::getFile
     * @covers Commentar\Presentation\Theme::getFilenameInTheme
     */
    public function testGetFileFoundFirstWithTrailingSlash()
    {
        $theme = new Theme(__DIR__ . '/../../Mocks/themes/', ['bar', 'baz']);

        $this->assertSame(__DIR__ . '/../../Mocks/themes/bar/page.phtml', $theme->getFile('page.phtml'));
    }

    /**
     * @covers Commentar\Presentation\Theme::__construct
     * @covers Commentar\Presentation\Theme::getFile
     * @covers Commentar\Presentation\Theme::getFilenameInTheme
     */
    public function testGetFileFoundFirstWithoutTrailingSlash()
    {
        $theme = new Theme(__DIR__ . '/../../Mocks/themes', ['bar', 'baz']);

        $this->assertSame(__DIR__ . '/../../Mocks/themes/bar/page.phtml', $theme->getFile('page.phtml'));
    }

    /**
     * @covers Commentar\Presentation\Theme::__construct
     * @covers Commentar\Presentation\Theme::getFile
     * @covers Commentar\Presentation\Theme::getFilenameInTheme
     */
    public function testGetFileFoundLatter()
    {
        $theme = new Theme(__DIR__ . '/../../Mocks/themes', ['baz', 'bar']);

        $this->assertSame(__DIR__ . '/../../Mocks/themes/bar/page.phtml', $theme->getFile('page.phtml'));
    }

    /**
     * @covers Commentar\Presentation\Theme::__construct
     * @covers Commentar\Presentation\Theme::getFile
     * @covers Commentar\Presentation\Theme::getFilenameInTheme
     */
    public function testGetFileThrowsExceptionNotFound()
    {
        $theme = new Theme(__DIR__ . '/../../Mocks/themes', ['foo', 'bar', 'baz']);

        $this->setExpectedException('\\Commentar\\Presentation\\InvalidFileException');

        $theme->getFile('non-existent-file.phtml');
    }
}
