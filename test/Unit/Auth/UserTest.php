<?php

namespace CommentarTest\Unit\Auth;

use Commentar\Auth\User;
use Commentar\DomainObject\User as DomainObject;

class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Auth\User::__construct
     */
    public function testConstructCorrectInterface()
    {
        $auth = new User([]);

        $this->assertInstanceOf('\\Commentar\\Auth\\Authenticator', $auth);
    }

    /**
     * @covers Commentar\Auth\User::__construct
     */
    public function testConstructCorrectInstance()
    {
        $auth = new User([]);

        $this->assertInstanceOf('\\Commentar\\Auth\\User', $auth);
    }

    /**
     * @covers Commentar\Auth\User::__construct
     * @covers Commentar\Auth\User::getUser
     */
    public function testConstructALreadyLoggedIn()
    {
        $domainObject = new DomainObject();
        $domainObject->fill(['username' => 'PeeHaa']);

        $auth = new User(['commentar_user' => serialize($domainObject)]);

        $user = $auth->getUser();

        $this->assertInstanceOf('\\Commentar\\DomainObject\\User', $user);
        $this->assertSame('PeeHaa', $user->getUsername());
    }

    /**
     * @covers Commentar\Auth\User::__construct
     * @covers Commentar\Auth\User::login
     * @covers Commentar\Auth\User::getUser
     */
    public function testLogin()
    {
        $auth = new User([]);

        $auth->login(new DomainObject());

        $this->assertInstanceOf('\\Commentar\\DomainObject\\User', $auth->getUser());
    }

    /**
     * @covers Commentar\Auth\User::__construct
     * @covers Commentar\Auth\User::login
     * @covers Commentar\Auth\User::getUser
     * @covers Commentar\Auth\User::logout
     */
    public function testLogout()
    {
        $auth = new User([]);

        $auth->login(new DomainObject());
        $auth->logout();

        $this->assertNull($auth->getUser());
    }

    /**
     * @covers Commentar\Auth\User::__construct
     * @covers Commentar\Auth\User::isLoggedIn
     */
    public function testIsLoggedInFalse()
    {
        $auth = new User([]);

        $this->assertFalse($auth->isLoggedIn());
    }

    /**
     * @covers Commentar\Auth\User::__construct
     * @covers Commentar\Auth\User::login
     * @covers Commentar\Auth\User::isLoggedIn
     */
    public function testIsLoggedInTrue()
    {
        $auth = new User([]);

        $auth->login(new DomainObject());

        $this->assertTrue($auth->isLoggedIn());
    }

    /**
     * @covers Commentar\Auth\User::__construct
     * @covers Commentar\Auth\User::isLoggedIn
     * @covers Commentar\Auth\User::isAdmin
     */
    public function testIsAdminNotLoggedIn()
    {
        $auth = new User([]);

        $this->assertFalse($auth->isAdmin());
    }

    /**
     * @covers Commentar\Auth\User::__construct
     * @covers Commentar\Auth\User::isLoggedIn
     * @covers Commentar\Auth\User::isAdmin
     */
    public function testIsAdminLoggedInTrue()
    {
        $auth = new User([]);

        $domainObject = new DomainObject();
        $domainObject->fill(['isAdmin' => true]);

        $auth->login($domainObject);

        $this->assertTrue($auth->isAdmin());
    }

    /**
     * @covers Commentar\Auth\User::__construct
     * @covers Commentar\Auth\User::isLoggedIn
     * @covers Commentar\Auth\User::isAdmin
     */
    public function testIsAdminLoggedInFalse()
    {
        $auth = new User([]);

        $domainObject = new DomainObject();
        $domainObject->fill(['isAdmin' => false]);

        $auth->login($domainObject);

        $this->assertFalse($auth->isAdmin());
    }

    /**
     * @covers Commentar\Auth\User::__construct
     * @covers Commentar\Auth\User::getUser
     */
    public function testGetUserNotLoggedIn()
    {
        $auth = new User([]);

        $this->assertNull($auth->getUser());
    }

    /**
     * @covers Commentar\Auth\User::__construct
     * @covers Commentar\Auth\User::login
     * @covers Commentar\Auth\User::getUser
     */
    public function testGetUserLoggedIn()
    {
        $auth = new User([]);

        $auth->login(new DomainObject());

        $this->assertInstanceOf('\\Commentar\\DomainObject\\User', $auth->getUser());
    }

    /**
     * @covers Commentar\Auth\User::__construct
     * @covers Commentar\Auth\User::getUserForSession
     */
    public function testGetUserForSessionNotLoggedIn()
    {
        $auth = new User([]);

        $this->assertNull($auth->getUserForSession());
    }

    /**
     * @covers Commentar\Auth\User::__construct
     * @covers Commentar\Auth\User::login
     * @covers Commentar\Auth\User::getUserForSession
     */
    public function testGetUserForSessionLoggedIn()
    {
        $auth = new User([]);

        $domainObject = new DomainObject();
        $domainObject->fill(['username' => 'PeeHaa']);

        $auth->login($domainObject);

        $user = unserialize($auth->getUserForSession());

        $this->assertSame('PeeHaa', $user->getUsername());
    }
}
