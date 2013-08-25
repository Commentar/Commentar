<?php

namespace CommentarTest\Http;

use Commentar\Http\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Http\Request::__construct
     */
    public function testConstructCorrectInterface()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $request = new Request($requestVariables, $requestVariables, $requestVariables, $requestVariables);

        $this->assertInstanceOf('\\Commentar\\Http\\RequestData', $request);
    }

    /**
     * @covers Commentar\Http\Request::__construct
     */
    public function testConstructCorrectInstance()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $request = new Request($requestVariables, $requestVariables, $requestVariables, $requestVariables);

        $this->assertInstanceOf('\\Commentar\\Http\\Request', $request);
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::get
     */
    public function testGetExists()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $getVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $getVariables->expects($this->any())->method('get')->will($this->returnValue('bar'));

        $request = new Request($getVariables, $requestVariables, $requestVariables, $requestVariables);

        $this->assertSame('bar', $request->get('foo'));
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::get
     */
    public function testGetNotExistsDefaultValue()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $request = new Request($requestVariables, $requestVariables, $requestVariables, $requestVariables);

        $this->assertNull($request->get('foo'));
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::get
     */
    public function testGetNotExistsCustomDefaultValue()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $getVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $getVariables->expects($this->any())->method('get')->will($this->returnArgument(1));

        $request = new Request($getVariables, $requestVariables, $requestVariables, $requestVariables);

        $this->assertSame('bar', $request->get('foo', 'bar'));
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::post
     */
    public function testPostExists()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $postVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $postVariables->expects($this->any())->method('get')->will($this->returnValue('bar'));

        $request = new Request($requestVariables, $postVariables, $requestVariables, $requestVariables);

        $this->assertSame('bar', $request->post('foo'));
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::post
     */
    public function testPostNotExistsDefaultValue()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $request = new Request($requestVariables, $requestVariables, $requestVariables, $requestVariables);

        $this->assertNull($request->post('foo'));
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::post
     */
    public function testPostNotExistsCustomDefaultValue()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $postVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $postVariables->expects($this->any())->method('get')->will($this->returnArgument(1));

        $request = new Request($requestVariables, $postVariables, $requestVariables, $requestVariables);

        $this->assertSame('bar', $request->post('foo', 'bar'));
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::server
     */
    public function testServerExists()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $serverVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('bar'));

        $request = new Request($requestVariables, $requestVariables, $serverVariables, $requestVariables);

        $this->assertSame('bar', $request->server('foo'));
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::server
     */
    public function testServerNotExistsDefaultValue()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $request = new Request($requestVariables, $requestVariables, $requestVariables, $requestVariables);

        $this->assertNull($request->server('foo'));
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::server
     */
    public function testServerNotExistsCustomDefaultValue()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $serverVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnArgument(1));

        $request = new Request($requestVariables, $requestVariables, $serverVariables, $requestVariables);

        $this->assertSame('bar', $request->server('foo', 'bar'));
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::files
     */
    public function testFilesExists()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $filesVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $filesVariables->expects($this->any())->method('get')->will($this->returnValue('bar'));

        $request = new Request($requestVariables, $requestVariables, $requestVariables, $filesVariables);

        $this->assertSame('bar', $request->files('foo'));
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::files
     */
    public function testFilesNotExistsDefaultValue()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $request = new Request($requestVariables, $requestVariables, $requestVariables, $requestVariables);

        $this->assertNull($request->server('foo'));
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::server
     */
    public function testFilesNotExistsCustomDefaultValue()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $filesVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $filesVariables->expects($this->any())->method('get')->will($this->returnArgument(1));

        $request = new Request($requestVariables, $requestVariables, $requestVariables, $filesVariables);

        $this->assertSame('bar', $request->files('foo', 'bar'));
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::getPath
     */
    public function testGetPath()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $serverVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('/foo/bar'));

        $request = new Request($requestVariables, $requestVariables, $serverVariables, $requestVariables);

        $this->assertSame('/foo/bar', $request->getPath());
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::getPath
     */
    public function testGetPathWithQueryString()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $serverVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('/foo/bar?foo=bar'));

        $request = new Request($requestVariables, $requestVariables, $serverVariables, $requestVariables);

        $this->assertSame('/foo/bar', $request->getPath());
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::isXhr
     */
    public function testIsXhrTrue()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $serverVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('XMLHttpRequest'));

        $request = new Request($requestVariables, $requestVariables, $serverVariables, $requestVariables);

        $this->assertTrue($request->isXhr());
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::isXhr
     */
    public function testIsXhrFalse()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $serverVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('XMLHttpRequestFalse'));

        $request = new Request($requestVariables, $requestVariables, $serverVariables, $requestVariables);

        $this->assertFalse($request->isXhr());
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::isSecure
     */
    public function testIsSecureTrueNotEmpty()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $serverVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('Non empty value'));

        $request = new Request($requestVariables, $requestVariables, $serverVariables, $requestVariables);

        $this->assertTrue($request->isSecure());
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::isSecure
     */
    public function testIsSecureTrueOn()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $serverVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('on'));

        $request = new Request($requestVariables, $requestVariables, $serverVariables, $requestVariables);

        $this->assertTrue($request->isSecure());
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::isSecure
     */
    public function testIsSecureFalseEmptyString()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $serverVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue(''));

        $request = new Request($requestVariables, $requestVariables, $serverVariables, $requestVariables);

        $this->assertFalse($request->isSecure());
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::isSecure
     */
    public function testIsSecureFalseNull()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $serverVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue(null));

        $request = new Request($requestVariables, $requestVariables, $serverVariables, $requestVariables);

        $this->assertFalse($request->isSecure());
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::isSecure
     */
    public function testIsSecureFalseOff()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $serverVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('off'));

        $request = new Request($requestVariables, $requestVariables, $serverVariables, $requestVariables);

        $this->assertFalse($request->isSecure());
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::getPath
     * @covers Commentar\Http\Request::isResource
     */
    public function testIsResourceTrue()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $serverVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('/foo/bar/file.ico'));

        $request = new Request($requestVariables, $requestVariables, $serverVariables, $requestVariables);

        $this->assertTrue($request->isResource());
    }

    /**
     * @covers Commentar\Http\Request::__construct
     * @covers Commentar\Http\Request::getPath
     * @covers Commentar\Http\Request::isResource
     */
    public function testIsResourceFalse()
    {
        $requestVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');

        $serverVariables = $this->getMock('\\Commentar\\Storage\\KeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('/foo/bar'));

        $request = new Request($requestVariables, $requestVariables, $serverVariables, $requestVariables);

        $this->assertFalse($request->isResource());
    }
}
