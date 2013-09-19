<?php

namespace CommentarTest\Unit\Security\CsrfToken\StorageMedium;

use Commentar\Security\CsrfToken\StorageMedium\Session;

class SessionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Security\CsrfToken::__construct
     */
    public function testConstructCorrectInterface()
    {
        $session = new Session('somekey', $this->getMock('\\Commentar\\Storage\\SessionInterface'));

        $this->assertInstanceOf('\\Commentar\\Security\\CsrfToken\\StorageMedium', $session);
    }

    /**
     * @covers Commentar\Security\CsrfToken::__construct
     */
    public function testConstructCorrectInstance()
    {
        $session = new Session('somekey', $this->getMock('\\Commentar\\Storage\\SessionInterface'));

        $this->assertInstanceOf('\\Commentar\\Security\\CsrfToken\\StorageMedium\\Session', $session);
    }

    /**
     * @covers Commentar\Security\CsrfToken\StorageMedium\Session::__construct
     * @covers Commentar\Security\CsrfToken\StorageMedium\Session::set
     */
    public function testSet()
    {
        $session = new Session('somekey', $this->getMock('\\Commentar\\Storage\\SessionInterface'));

        $this->assertSame(null, $session->set('whatever'));
    }

    /**
     * @covers Commentar\Security\CsrfToken\StorageMedium\Session::__construct
     * @covers Commentar\Security\CsrfToken\StorageMedium\Session::get
     */
    public function testGetWithoutValue()
    {
        $storage = $this->getMock('\\Commentar\\Storage\\SessionInterface');
        $storage->expects($this->any())
            ->method('isKeyValid')
            ->will($this->returnValue(true));

        $session = new Session('somekey', $storage);

        $this->assertSame(null, $session->get());
    }

    /**
     * @covers Commentar\Security\CsrfToken\StorageMedium\Session::__construct
     * @covers Commentar\Security\CsrfToken\StorageMedium\Session::set
     * @covers Commentar\Security\CsrfToken\StorageMedium\Session::get
     */
    public function testGetWithValue()
    {
        $storage = $this->getMock('\\Commentar\\Storage\\SessionInterface');
        $storage->expects($this->any())
            ->method('set')
            ->will($this->returnCallback(function ($value) {
                \PHPUnit_Framework_Assert::assertSame('foo', $value);
            }));
        $storage->expects($this->any())
            ->method('get')
            ->will($this->returnValue('foo'));
        $storage->expects($this->any())
            ->method('isKeyValid')
            ->will($this->returnValue(true));

        $session = new Session('foo', $storage);
        $session->set('foo');

        $this->assertSame('foo', $session->get());
    }
}
