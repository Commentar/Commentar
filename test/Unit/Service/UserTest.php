<?php

namespace CommentarTest\Unit\Service;

use Commentar\Service\User;

//use Commentar\DomainObject\Builder as DomainObjectBuilder;
//use Commentar\Storage\Datamapper\Builder as DatamapperBuilder;
//use Commentar\Http\RequestData;
//use Commentar\Auth\Authenticator;

class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Service\User::__construct
     */
    public function testConstructCorrectInstance()
    {
        $user = new User(
            $this->getMock('\\Commentar\\DomainObject\\Builder'),
            $this->getMock('\\Commentar\\Storage\\Datamapper\\Builder')
        );

        $this->assertInstanceOf('\\Commentar\\Service\\User', $user);
    }

    /**
     * @covers Commentar\Service\User::__construct
     * @covers Commentar\Service\User::login
     */
    public function testLoginInvalidPassword()
    {
        $domainObject = new \Commentar\DomainObject\User();

        $domainObjectFactory = $this->getMock('\\Commentar\\DomainObject\\Builder');
        $domainObjectFactory->expects($this->any())
            ->method('build')
            ->will($this->returnValue($domainObject));

        $datamapper = $this->getMock('\\Commentar\\Storage\\Datamapper\\UserMappable');
        $datamapper->expects($this->any())
            ->method('fetchByUsername')
            ->will($this->returnValue($domainObject));

        $dataMapperFactory = $this->getMock('\\Commentar\\Storage\\Datamapper\\Builder');
        $dataMapperFactory->expects($this->any())
            ->method('build')
            ->will($this->returnValue($datamapper));

        $user = new User($domainObjectFactory, $dataMapperFactory);

        $request = $this->getMock('\\Commentar\\Http\\RequestData');
        $request->expects($this->any())
            ->method('post')
            ->will($this->returnValue('invalidpassword'));

        $this->assertFalse($user->login($request, $this->getMock('\\Commentar\\Auth\\Authenticator')));
    }

    /**
     * @covers Commentar\Service\User::__construct
     * @covers Commentar\Service\User::login
     * @covers Commentar\Service\User::rehashWhenNeeded
     */
    public function testLoginInvalPasswordNoRehash()
    {
        $domainObject = new \Commentar\DomainObject\User();
        $domainObject->fill(['password' => '$2y$14$1dSI8Q4fs/zZHO7xzCSzKOjQ0rRwBNCe.I0P4.fx9cA1icaLRacBK']);

        $domainObjectFactory = $this->getMock('\\Commentar\\DomainObject\\Builder');
        $domainObjectFactory->expects($this->any())
            ->method('build')
            ->will($this->returnValue($domainObject));

        $datamapper = $this->getMock('\\Commentar\\Storage\\Datamapper\\UserMappable');
        $datamapper->expects($this->any())
            ->method('fetchByUsername')
            ->will($this->returnValue($domainObject));

        $dataMapperFactory = $this->getMock('\\Commentar\\Storage\\Datamapper\\Builder');
        $dataMapperFactory->expects($this->any())
            ->method('build')
            ->will($this->returnValue($datamapper));

        $user = new User($domainObjectFactory, $dataMapperFactory);

        $request = $this->getMock('\\Commentar\\Http\\RequestData');
        $request->expects($this->any())
            ->method('post')
            ->will($this->returnValue('validpassword'));

        $this->assertTrue($user->login($request, $this->getMock('\\Commentar\\Auth\\Authenticator')));
        $this->assertSame('$2y$14$1dSI8Q4fs/zZHO7xzCSzKOjQ0rRwBNCe.I0P4.fx9cA1icaLRacBK', $domainObject->getPassword());
    }

    /**
     * @covers Commentar\Service\User::__construct
     * @covers Commentar\Service\User::login
     * @covers Commentar\Service\User::rehashWhenNeeded
     */
    public function testLoginInvalPasswordNeedsRehash()
    {
        $domainObject = new \Commentar\DomainObject\User();
        $domainObject->fill(['password' => '$2y$04$BqL9tu3v/mHEVLGeo/F3lujWf9Nx32en/KfbAUOX7NQGsiaDG7mGC']);

        $domainObjectFactory = $this->getMock('\\Commentar\\DomainObject\\Builder');
        $domainObjectFactory->expects($this->any())
            ->method('build')
            ->will($this->returnValue($domainObject));

        $datamapper = $this->getMock('\\Commentar\\Storage\\Datamapper\\UserMappable');
        $datamapper->expects($this->any())
            ->method('fetchByUsername')
            ->will($this->returnValue($domainObject));

        $dataMapperFactory = $this->getMock('\\Commentar\\Storage\\Datamapper\\Builder');
        $dataMapperFactory->expects($this->any())
            ->method('build')
            ->will($this->returnValue($datamapper));

        $user = new User($domainObjectFactory, $dataMapperFactory);

        $request = $this->getMock('\\Commentar\\Http\\RequestData');
        $request->expects($this->any())
            ->method('post')
            ->will($this->returnValue('validpassword'));

        $this->assertTrue($user->login($request, $this->getMock('\\Commentar\\Auth\\Authenticator')));
        $this->assertStringStartsWith('$2y$14$', $domainObject->getPassword());
    }
}
