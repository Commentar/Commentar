<?php

namespace CommentarTest\Http;

use Commentar\Http\Response;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testConstructCorrectInterface()
    {
        $response = new Response();

        $this->assertInstanceOf('\\Commentar\\Http\\ResponseData', $response);
    }

    /**
     *
     */
    public function testConstructCorrectInstance()
    {
        $response = new Response();

        $this->assertInstanceOf('\\Commentar\\Http\\Response', $response);
    }

    /**
     * @covers Commentar\Http\Response::addHeader
     */
    public function testAddHeaderNew()
    {
        $response = new Response();

        $this->assertNull($response->addHeader('foo', 'bar'));
    }

    /**
     * @covers Commentar\Http\Response::addHeader
     */
    public function testAddHeaderMultiple()
    {
        $response = new Response();

        $this->assertNull($response->addHeader('foo', 'bar'));
        $this->assertNull($response->addHeader('foo', 'baz'));
    }

    /**
     * @covers Commentar\Http\Response::setContentType
     */
    public function testSetContentType()
    {
        $response = new Response();

        $this->assertNull($response->setContentType('text/html'));
    }

    /**
     * @covers Commentar\Http\Response::setContentType
     */
    public function testSetContentTypeOverwrite()
    {
        $response = new Response();

        $this->assertNull($response->setContentType('text/html'));
        $this->assertNull($response->setContentType('application/json'));
    }

    /**
     * @covers Commentar\Http\Response::setBody
     */
    public function testSetBody()
    {
        $response = new Response();

        $this->assertNull($response->setBody('body'));
    }

    /**
     * @covers Commentar\Http\Response::setBody
     */
    public function testSetBodyOverwrite()
    {
        $response = new Response();

        $this->assertNull($response->setBody('body'));
        $this->assertNull($response->setBody('overwritten'));
    }

    /**
     * @covers Commentar\Http\Response::addHeader
     * @covers Commentar\Http\Response::setContentType
     * @covers Commentar\Http\Response::setBody
     * @covers Commentar\Http\Response::renderHeaders
     * @covers Commentar\Http\Response::render
     *
     * @runInSeparateProcess
     */
    public function testRenderBody()
    {
        $response = new Response();

        $this->assertNull($response->addHeader('foo', 'bar'));
        $this->assertNull($response->setContentType('text/html'));
        $this->assertNull($response->setBody('body content'));

        $this->assertSame('body content', $response->render());
    }

    /**
     * @covers Commentar\Http\Response::addHeader
     * @covers Commentar\Http\Response::setContentType
     * @covers Commentar\Http\Response::setBody
     * @covers Commentar\Http\Response::renderHeaders
     * @covers Commentar\Http\Response::render
     *
     * @runInSeparateProcess
     */
    public function testRenderBodyOverwritten()
    {
        $response = new Response();

        $this->assertNull($response->addHeader('foo', 'bar'));
        $this->assertNull($response->setContentType('text/html'));
        $this->assertNull($response->setBody('body content'));
        $this->assertNull($response->setBody('overwritten content'));

        $this->assertSame('overwritten content', $response->render());
    }

    /**
     * @covers Commentar\Http\Response::addHeader
     * @covers Commentar\Http\Response::setContentType
     * @covers Commentar\Http\Response::setBody
     * @covers Commentar\Http\Response::renderHeaders
     * @covers Commentar\Http\Response::render
     *
     * @runInSeparateProcess
     */
    public function testRenderContentType()
    {
        $response = new Response();

        $this->assertNull($response->addHeader('foo', 'bar'));
        $this->assertNull($response->setContentType('text/css'));
        $this->assertNull($response->setBody('body content'));

        $this->assertSame('body content', $response->render());

        $this->assertContains('Content-Type: text/css', xdebug_get_headers());
    }

    /**
     * @covers Commentar\Http\Response::addHeader
     * @covers Commentar\Http\Response::setContentType
     * @covers Commentar\Http\Response::setBody
     * @covers Commentar\Http\Response::renderHeaders
     * @covers Commentar\Http\Response::render
     *
     * @runInSeparateProcess
     */
    public function testRenderContentTypeOverwritten()
    {
        $response = new Response();

        $this->assertNull($response->addHeader('foo', 'bar'));
        $this->assertNull($response->setContentType('text/css'));
        $this->assertNull($response->setContentType('text/html'));
        $this->assertNull($response->setBody('body content'));

        $this->assertSame('body content', $response->render());

        $this->assertContains('Content-Type: text/html', xdebug_get_headers());
    }

    /**
     * @covers Commentar\Http\Response::addHeader
     * @covers Commentar\Http\Response::setContentType
     * @covers Commentar\Http\Response::setBody
     * @covers Commentar\Http\Response::renderHeaders
     * @covers Commentar\Http\Response::render
     *
     * @runInSeparateProcess
     */
    public function testRenderHeaders()
    {
        $response = new Response();

        $this->assertNull($response->addHeader('foo', 'bar'));
        $this->assertNull($response->addHeader('foo', 'baz'));
        $this->assertNull($response->setBody('body content'));

        $this->assertSame('body content', $response->render());

        $this->assertContains('foo: bar,baz', xdebug_get_headers());
    }
}
