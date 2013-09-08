<?php

namespace CommentarTest\Presentation;

use Commentar\Presentation\Resource;

class ResourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Presentation\Resource::__construct
     */
    public function testConstructCorrectInterface()
    {
        $resource = new Resource(
            $this->getMock('\\Commentar\\Http\\RequestData'),
            $this->getMock('\\Commentar\\Http\\ResponseData'),
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\ResourceLoader', $resource);
    }

    /**
     * @covers Commentar\Presentation\Resource::__construct
     */
    public function testConstructCorrectInstance()
    {
        $resource = new Resource(
            $this->getMock('\\Commentar\\Http\\RequestData'),
            $this->getMock('\\Commentar\\Http\\ResponseData'),
            $this->getMock('\\Commentar\\Presentation\\ThemeLoader')
        );

        $this->assertInstanceOf('\\Commentar\\Presentation\\Resource', $resource);
    }

    /**
     * @covers Commentar\Presentation\Resource::__construct
     * @covers Commentar\Presentation\Resource::load
     * @covers Commentar\Presentation\Resource::isValidResource
     */
    public function testLoadNonExistentFile()
    {
        $response = $this->getMock('\\Commentar\\Http\\ResponseData');
        $response->expects($this->any())
            ->method('setStatusCode')
            ->will($this->returnCallback(function ($statusCode) {
                \PHPUnit_Framework_Assert::assertSame('HTTP/1.1 404 Not Found', $statusCode);
            }));

        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue('/fake/path/to/my/file.css'));

        $resource = new Resource($this->getMock('\\Commentar\\Http\\RequestData'), $response, $theme);

        $this->assertNull($resource->load('somefile'));
    }

    /**
     * @covers Commentar\Presentation\Resource::__construct
     * @covers Commentar\Presentation\Resource::load
     * @covers Commentar\Presentation\Resource::isValidResource
     */
    public function testLoadInvalidType()
    {
        $response = $this->getMock('\\Commentar\\Http\\ResponseData');
        $response->expects($this->any())
            ->method('setStatusCode')
            ->will($this->returnCallback(function ($statusCode) {
                \PHPUnit_Framework_Assert::assertSame('HTTP/1.1 404 Not Found', $statusCode);
            }));

        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../Mocks/themes/bar/file.unsupported'));

        $resource = new Resource($this->getMock('\\Commentar\\Http\\RequestData'), $response, $theme);

        $this->assertNull($resource->load('bar/file.unsupported'));
    }

    /**
     * @covers Commentar\Presentation\Resource::__construct
     * @covers Commentar\Presentation\Resource::load
     * @covers Commentar\Presentation\Resource::isValidResource
     * @covers Commentar\Presentation\Resource::isCached
     */
    public function testLoadCachedFile()
    {
        $request = $this->getMock('\\Commentar\\Http\\RequestData');
        $request->expects($this->any())
            ->method('server')
            ->will($this->returnValue(gmdate('D, d M Y H:i:s', filemtime(__DIR__ . '/../../Mocks/themes/bar/file.css')).' GMT'));

        $response = $this->getMock('\\Commentar\\Http\\ResponseData');
        $response->expects($this->any())
            ->method('setStatusCode')
            ->will($this->returnCallback(function ($statusCode) {
                \PHPUnit_Framework_Assert::assertSame('HTTP/1.1 304 Not Modified', $statusCode);
            }));

        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../Mocks/themes/bar/file.css'));

        $resource = new Resource($request, $response, $theme);

        $this->assertNull($resource->load('somefile'));
    }

    /**
     * @covers Commentar\Presentation\Resource::__construct
     * @covers Commentar\Presentation\Resource::load
     * @covers Commentar\Presentation\Resource::isValidResource
     * @covers Commentar\Presentation\Resource::setContentType
     * @covers Commentar\Presentation\Resource::isCached
     * @covers Commentar\Presentation\Resource::render
     */
    public function testLoadSuccess()
    {
        $response = $this->getMock('\\Commentar\\Http\\ResponseData');
        $response->expects($this->any())
            ->method('setContentType')
            ->will($this->returnCallback(function ($contentType) {
                \PHPUnit_Framework_Assert::assertSame('text/css', $contentType);
            }));

        $theme = $this->getMock('\\Commentar\\Presentation\\ThemeLoader');
        $theme->expects($this->any())
            ->method('getFile')
            ->will($this->returnValue(__DIR__ . '/../../Mocks/themes/bar/file.css'));

        $resource = new Resource($this->getMock('\\Commentar\\Http\\RequestData'), $response, $theme);

        $this->assertSame('css file', $resource->load('bar/file.css'));
    }
}
