<?php

namespace CommentarTest\Presentation;

use Commentar\Presentation\Theme;

class ThemeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Presentation\Theme::__construct
     */
    public function testConstructCorrectInstance()
    {
        $theme = new Theme([], __DIR__);

        $this->assertInstanceOf('\\Commentar\\Presentation\\Theme', $theme);
    }

    /**
     * @covers Commentar\Presentation\Theme::__construct
     * @covers Commentar\Presentation\Theme::load
     * @covers Commentar\Presentation\Theme::loadTemplate
     * @covers Commentar\Presentation\Theme::renderTemplate
     * @covers Commentar\Presentation\Theme::getFirstMatchingFile
     * @covers Commentar\Presentation\Theme::getFilenameInTheme
     */
    public function testLoadSingleTemplate()
    {
        $theme = new Theme(['foo'], __DIR__ . '/../../Mocks/themes/');

        $this->assertSame('footheme', $theme->load());
    }

    /**
     * @covers Commentar\Presentation\Theme::__construct
     * @covers Commentar\Presentation\Theme::load
     * @covers Commentar\Presentation\Theme::loadTemplate
     * @covers Commentar\Presentation\Theme::renderTemplate
     * @covers Commentar\Presentation\Theme::getFirstMatchingFile
     * @covers Commentar\Presentation\Theme::getFilenameInTheme
     */
    public function testLoadMultipleTemplatesFirst()
    {
        $theme = new Theme(['foo', 'bar'], __DIR__ . '/../../Mocks/themes/');

        $this->assertSame('footheme', $theme->load());
    }

    /**
     * @covers Commentar\Presentation\Theme::__construct
     * @covers Commentar\Presentation\Theme::load
     * @covers Commentar\Presentation\Theme::loadTemplate
     * @covers Commentar\Presentation\Theme::renderTemplate
     * @covers Commentar\Presentation\Theme::getFirstMatchingFile
     * @covers Commentar\Presentation\Theme::getFilenameInTheme
     */
    public function testLoadMultipleTemplatesMissingFirst()
    {
        $theme = new Theme(['baz', 'foo'], __DIR__ . '/../../Mocks/themes/');

        $this->assertSame('footheme', $theme->load());
    }

    /**
     * @covers Commentar\Presentation\Theme::__construct
     * @covers Commentar\Presentation\Theme::loadTemplate
     * @covers Commentar\Presentation\Theme::renderTemplate
     * @covers Commentar\Presentation\Theme::getFirstMatchingFile
     * @covers Commentar\Presentation\Theme::getFilenameInTheme
     */
    public function testLoadTemplateSingle()
    {
        $theme = new Theme(['foo'], __DIR__ . '/../../Mocks/themes/');

        $this->assertSame('foopartial', $theme->loadTemplate('partial.phtml'));
    }

    /**
     * @covers Commentar\Presentation\Theme::__construct
     * @covers Commentar\Presentation\Theme::loadTemplate
     * @covers Commentar\Presentation\Theme::renderTemplate
     * @covers Commentar\Presentation\Theme::getFirstMatchingFile
     * @covers Commentar\Presentation\Theme::getFilenameInTheme
     */
    public function testLoadTemplateMultipleFirst()
    {
        $theme = new Theme(['foo', 'bar'], __DIR__ . '/../../Mocks/themes/');

        $this->assertSame('foopartial', $theme->loadTemplate('partial.phtml'));
    }

    /**
     * @covers Commentar\Presentation\Theme::__construct
     * @covers Commentar\Presentation\Theme::loadTemplate
     * @covers Commentar\Presentation\Theme::renderTemplate
     * @covers Commentar\Presentation\Theme::getFirstMatchingFile
     * @covers Commentar\Presentation\Theme::getFilenameInTheme
     */
    public function testLoadTemplateMultipleMissingFirst()
    {
        $theme = new Theme(['baz', 'foo'], __DIR__ . '/../../Mocks/themes/');

        $this->assertSame('foopartial', $theme->loadTemplate('partial.phtml'));
    }
}
