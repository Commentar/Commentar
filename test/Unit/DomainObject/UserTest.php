<?php

namespace CommentarTest\DomainObject;

use Commentar\DomainObject\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testConstructCorrectInstance()
    {
        $user = new User();

        $this->assertInstanceOf('\\Commentar\\DomainObject\\User', $user);
    }

    /**
     * @covers Commentar\DomainObject\User::fill
     */
    public function testFillInvalidProperty()
    {
        $user = new User();

        $this->setExpectedException('\\Commentar\\DomainObject\\InvalidPropertyException');

        $user->fill(['undefinedProperty' => true]);
    }

    /**
     * @covers Commentar\DomainObject\User::fill
     * @covers Commentar\DomainObject\User::setId
     * @covers Commentar\DomainObject\User::getId
     */
    public function testGetIdFilled()
    {
        $user = new User();

        $user->fill(['id' => 1]);

        $this->assertSame(1, $user->getId());
    }

    /**
     * @covers Commentar\DomainObject\User::fill
     * @covers Commentar\DomainObject\User::setId
     * @covers Commentar\DomainObject\User::getId
     */
    public function testGetIdCasted()
    {
        $user = new User();

        $user->fill(['id' => '1']);

        $this->assertSame(1, $user->getId());
    }

    /**
     * @covers Commentar\DomainObject\User::getId
     */
    public function testGetIdDefault()
    {
        $user = new User();

        $this->assertNull($user->getId());
    }

    /**
     * @covers Commentar\DomainObject\User::fill
     * @covers Commentar\DomainObject\User::setUsername
     * @covers Commentar\DomainObject\User::getUsername
     */
    public function testGetUsernameFilled()
    {
        $user = new User();

        $user->fill(['username' => 'PeeHaa']);

        $this->assertSame('PeeHaa', $user->getUsername());
    }

    /**
     * @covers Commentar\DomainObject\User::getUsername
     */
    public function testGetUsernameDefault()
    {
        $user = new User();

        $this->assertNull($user->getUsername());
    }

    /**
     * @covers Commentar\DomainObject\User::fill
     * @covers Commentar\DomainObject\User::setPassword
     * @covers Commentar\DomainObject\User::getPassword
     */
    public function testGetPasswordFilled()
    {
        $user = new User();

        $user->fill(['password' => 'dkjshsjdkhcdjsh']);

        $this->assertSame('dkjshsjdkhcdjsh', $user->getPassword());
    }

    /**
     * @covers Commentar\DomainObject\User::getPassword
     */
    public function testGetPasswordDefault()
    {
        $user = new User();

        $this->assertNull($user->getPassword());
    }

    /**
     * @covers Commentar\DomainObject\User::fill
     * @covers Commentar\DomainObject\User::setEmail
     */
    public function testSetEmailInvalid()
    {
        $user = new User();

        $this->setExpectedException('\\Commentar\\DomainObject\\InvalidValueException');

        $user->fill(['email' => 'peehaa']);
    }

    /**
     * @covers Commentar\DomainObject\User::fill
     * @covers Commentar\DomainObject\User::setEmail
     * @covers Commentar\DomainObject\User::getEmail
     */
    public function testGetEmailFilled()
    {
        $user = new User();

        $user->fill(['email' => 'peehaa@php.net']);

        $this->assertSame('peehaa@php.net', $user->getEmail());
    }

    /**
     * @covers Commentar\DomainObject\User::getEmail
     */
    public function testGetEmailDefault()
    {
        $user = new User();

        $this->assertNull($user->getEMail());
    }

    /**
     * @covers Commentar\DomainObject\User::fill
     * @covers Commentar\DomainObject\User::setIsHellbanned
     * @covers Commentar\DomainObject\User::isHellbanned
     */
    public function testIsHellbannedFilled()
    {
        $user = new User();

        $user->fill(['isHellbanned' => true]);

        $this->assertTrue($user->isHellbanned());
    }

    /**
     * @covers Commentar\DomainObject\User::fill
     * @covers Commentar\DomainObject\User::setIsHellbanned
     * @covers Commentar\DomainObject\User::isHellbanned
     */
    public function testIsHellbannedCasted()
    {
        $user = new User();

        $user->fill(['isHellbanned' => '1']);

        $this->assertTrue($user->isHellbanned());
    }

    /**
     * @covers Commentar\DomainObject\User::isHellbanned
     */
    public function testIsHellbannedDefault()
    {
        $user = new User();

        $this->assertFalse($user->isHellbanned());
    }

    /**
     * @covers Commentar\DomainObject\User::fill
     * @covers Commentar\DomainObject\User::setIsAdmin
     * @covers Commentar\DomainObject\User::isAdmin
     */
    public function testIsAdminFilled()
    {
        $user = new User();

        $user->fill(['isAdmin' => true]);

        $this->assertTrue($user->isAdmin());
    }

    /**
     * @covers Commentar\DomainObject\User::fill
     * @covers Commentar\DomainObject\User::setIsAdmin
     * @covers Commentar\DomainObject\User::isAdmin
     */
    public function testIsAdminCasted()
    {
        $user = new User();

        $user->fill(['isAdmin' => '1']);

        $this->assertTrue($user->isAdmin());
    }

    /**
     * @covers Commentar\DomainObject\User::isAdmin
     */
    public function testIsAdminDefault()
    {
        $user = new User();

        $this->assertFalse($user->isAdmin());
    }
}
