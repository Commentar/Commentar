<?php

namespace CommentarTest\Unit\Storage;

use Commentar\Storage\Session;

class SessionTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testConstructCorrectInterface()
    {
        $session = new Session();

        $this->assertInstanceOf('\\Commentar\\Storage\\SessionInterface', $session);
    }

    /**
     *
     */
    public function testConstructCorrectInstance()
    {
        $session = new Session();

        $this->assertInstanceOf('\\Commentar\\Storage\\Session', $session);;
    }

    /**
     * @covers Commentar\Storage\Session::set
     */
    public function testSet()
    {
        $session = new Session();

        $this->assertNull($session->set('key', 'value'));
    }

    /**
     * @covers Commentar\Storage\Session::set
     * @covers Commentar\Storage\Session::isKeyValid
     * @covers Commentar\Storage\Session::get
     */
    public function testGetValid()
    {
        $session = new Session();
        $session->set('key', 'value');

        $this->assertSame('value', $session->get('key'));
    }

    /**
     * @covers Commentar\Storage\Session::set
     * @covers Commentar\Storage\Session::isKeyValid
     * @covers Commentar\Storage\Session::get
     */
    public function testGetInvalidWithDefault()
    {
        $session = new Session();

        $this->assertsame('foo', $session->get('key', 'foo'));
    }

    /**
     * @covers Commentar\Storage\Session::set
     * @covers Commentar\Storage\Session::isKeyValid
     * @covers Commentar\Storage\Session::get
     */
    public function testGetInvalidWithoutDefault()
    {
        $session = new Session();
        $this->setExpectedException('\\Commentar\\Storage\\InvalidKeyException');

        $session->get('key');
    }

    /**
     * @covers Commentar\Storage\Session::isKeyValid
     */
    public function testIsKeyValidFail()
    {
        $session = new Session();

        $this->assertFalse(false, $session->isKeyValid('unknownkey'));
    }

    /**
     * @covers Commentar\Storage\Session::set
     * @covers Commentar\Storage\Session::isKeyValid
     */
    public function testIsKeyValidSuccess()
    {
        $session = new Session();
        $session->set('key', 'value');

        $this->assertTrue($session->isKeyValid('key'));
    }

    /**
     * @covers Commentar\Storage\Session::set
     * @covers Commentar\Storage\Session::delete
     */
    public function testDelete()
    {
        $session = new Session();
        $session->set('key', 'value');

        $this->assertNull($session->delete('key'));
    }
}
