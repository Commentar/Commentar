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
        $resource = new ResourceLoader();

        $this->assertInstanceOf('\\Commentar\\Presentation\\Resource', $resource);
    }

    /**
     *
     */
    public function testConstructCorrectInstance()
    {
        $resource = new ResourceLoader();

        $this->assertInstanceOf('\\Commentar\\Presentation\\ResourceLoader', $resource);
    }

    /**
     * @covers Commentar\Presentation\ResourceLoader::isValidResource
     * @covers Commentar\Presentation\ResourceLoader::load
     *
     * @runInSeparateProcess
     */
    public function testLoadNotExistentFile()
    {
        $resource = new ResourceLoader();

        $this->assertNull($resource->load('/foo/bar/non/existent/file.ico'));
    }

    /**
     * @covers Commentar\Presentation\ResourceLoader::isValidResource
     * @covers Commentar\Presentation\ResourceLoader::load
     *
     * @runInSeparateProcess
     */
    public function testLoadUnsupportedFile()
    {
        $resource = new ResourceLoader();

        $this->assertNull($resource->load('/foo/bar/non/existent/file.php'));
    }

    /**
     * @covers Commentar\Presentation\ResourceLoader::isValidResource
     * @covers Commentar\Presentation\ResourceLoader::load
     *
     * @runInSeparateProcess
     */
    public function testLoadSuccess()
    {
        $resource = new ResourceLoader();

        $this->assertSame('fooresource', $resource->load(__DIR__ . '/../../Mocks/themes/foo/resource.css'));
        $this->assertContains('Content-Type: text/css', xdebug_get_headers());
    }
}
