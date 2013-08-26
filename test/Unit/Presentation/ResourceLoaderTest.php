<?php

namespace CommentarTest\Presentation;

use Commentar\Presentation\ResourceLoader;

class ResourceLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testConstructCorrectInterface()
    {
        $resource = new ResourceLoader($this->getMock('\\Commentar\\Http\\ResponseData'));

        $this->assertInstanceOf('\\Commentar\\Presentation\\Resource', $resource);
    }

    /**
     *
     */
    public function testConstructCorrectInstance()
    {
        $resource = new ResourceLoader($this->getMock('\\Commentar\\Http\\ResponseData'));

        $this->assertInstanceOf('\\Commentar\\Presentation\\ResourceLoader', $resource);
    }

    /**
     * @covers Commentar\Presentation\ResourceLoader::isValidResource
     * @covers Commentar\Presentation\ResourceLoader::load
     */
    public function testLoadNotExistentFile()
    {
        $resource = new ResourceLoader($this->getMock('\\Commentar\\Http\\ResponseData'));

        $this->assertNull($resource->load('/foo/bar/non/existent/file.ico'));
    }

    /**
     * @covers Commentar\Presentation\ResourceLoader::isValidResource
     * @covers Commentar\Presentation\ResourceLoader::load
     */
    public function testLoadUnsupportedFile()
    {
        $resource = new ResourceLoader($this->getMock('\\Commentar\\Http\\ResponseData'));

        $this->assertNull($resource->load('/foo/bar/non/existent/file.php'));
    }

    /**
     * @covers Commentar\Presentation\ResourceLoader::isValidResource
     * @covers Commentar\Presentation\ResourceLoader::load
     */
    public function testLoadSuccess()
    {
        $responseMock = $this->getMock('\\Commentar\\Http\\ResponseData');

        $resource = new ResourceLoader($responseMock);

        $responseMock->expects($this->once())->method('setContentType')->will($this->returnCallback(function($contentType) {
            \PHPUnit_Framework_Assert::assertSame('text/css', $contentType);
        }));

        $responseMock->expects($this->once())->method('setBody')->will($this->returnCallback(function($body) {
            \PHPUnit_Framework_Assert::assertSame('fooresource', $body);
        }));

        $this->assertNull($resource->load(__DIR__ . '/../../Mocks/themes/foo/resource.css'));
    }
}
