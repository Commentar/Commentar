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
        $theme = new Theme(__DIR__, $this->getMock('\\Commentar\\Presentation\\Resource'), []);

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
        $theme = new Theme(
            __DIR__ . '/../../Mocks/themes/',
            $this->getMock('\\Commentar\\Presentation\\Resource'),
            ['foo']
        );

        $responseMock = $this->getMock('\\Commentar\\Http\ResponseData');
        $responseMock->expects($this->once())->method('setBody')->will($this->returnCallback(function($body) {
            \PHPUnit_Framework_Assert::assertSame('footheme', $body);
        }));

        $theme->load($responseMock);
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
        $theme = new Theme(
            __DIR__ . '/../../Mocks/themes/',
            $this->getMock('\\Commentar\\Presentation\\Resource'),
            ['foo', 'bar']
        );

        $responseMock = $this->getMock('\\Commentar\\Http\ResponseData');
        $responseMock->expects($this->once())->method('setBody')->will($this->returnCallback(function($body) {
            \PHPUnit_Framework_Assert::assertSame('footheme', $body);
        }));

        $theme->load($responseMock);
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
        $theme = new Theme(
            __DIR__ . '/../../Mocks/themes/',
            $this->getMock('\\Commentar\\Presentation\\Resource'),
            ['baz', 'foo']
        );

        $responseMock = $this->getMock('\\Commentar\\Http\ResponseData');
        $responseMock->expects($this->once())->method('setBody')->will($this->returnCallback(function($body) {
            \PHPUnit_Framework_Assert::assertSame('footheme', $body);
        }));

        $theme->load($responseMock);
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
        $theme = new Theme(
            __DIR__ . '/../../Mocks/themes/',
            $this->getMock('\\Commentar\\Presentation\\Resource'),
            ['foo']
        );

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
        $theme = new Theme(
            __DIR__ . '/../../Mocks/themes/',
            $this->getMock('\\Commentar\\Presentation\\Resource'),
            ['foo', 'bar']
        );

        $this->assertSame('foopartial', $theme->loadTemplate('partial.phtml'));
    }

    /**
     * @covers Commentar\Presentation\Theme::__construct
     * @covers Commentar\Presentation\Theme::loadResource
     * @covers Commentar\Presentation\Theme::getFirstMatchingFile
     * @covers Commentar\Presentation\Theme::getFilenameInTheme
     */
    public function testLoadResource()
    {
        $resource = $this->getMock('\\Commentar\\Presentation\\Resource');
        $resource->expects($this->any())->method('load')->will($this->returnValue('resource content'));

        $theme = new Theme(__DIR__ . '/../../Mocks/themes/', $resource, ['baz', 'foo']);

        $this->assertSame('resource content', $theme->loadResource('resource.css'));
    }
}
