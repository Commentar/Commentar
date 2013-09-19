<?php

namespace CommentarTest\Unit\Security;

use Commentar\Security\CsrfToken;

class CsrfTokenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Security\CsrfToken::__construct
     */
    public function testConstructCorrectInterface()
    {
        $csrfToken = new CsrfToken(
            $this->getMock('\\Commentar\\Security\\CsrfToken\\StorageMedium'),
            $this->getMock('\\Commentar\\Security\\Generator\\Builder')
        );

        $this->assertInstanceOf('\\Commentar\\Security\\TokenGenerator', $csrfToken);
    }

    /**
     * @covers Commentar\Security\CsrfToken::__construct
     */
    public function testConstructCorrectInstance()
    {
        $csrfToken = new CsrfToken(
            $this->getMock('\\Commentar\\Security\\CsrfToken\\StorageMedium'),
            $this->getMock('\\Commentar\\Security\\Generator\\Builder')
        );

        $this->assertInstanceOf('\\Commentar\\Security\\CsrfToken', $csrfToken);
    }

    /**
     * @covers Commentar\Security\CsrfToken::__construct
     * @covers Commentar\Security\CsrfToken::getToken
     * @covers Commentar\Security\CsrfToken::generateToken
     */
    public function testGetTokenThrowsExceptionInvalidLength()
    {
        $this->setExpectedException('\\Commentar\\Security\\Generator\\InvalidLengthException');

        $generator = $this->getMock('\\Commentar\\Security\\Generator');
        $generator->expects($this->any())
            ->method('generateToken')
            ->will($this->returnValue('.'));

        $factory = $this->getMock('\\Commentar\\Security\\Generator\\Builder');
        $factory->expects($this->any())
            ->method('build')
            ->will($this->returnValue($generator));

        $csrfToken = new CsrfToken(
            $this->getMock('\\Commentar\\Security\\CsrfToken\\StorageMedium'),
            $factory,
            ['customGenerator']
        );

        $csrfToken->getToken();
    }

    /**
     * @covers Commentar\Security\CsrfToken::__construct
     * @covers Commentar\Security\CsrfToken::getToken
     * @covers Commentar\Security\CsrfToken::generateToken
     */
    public function testGetTokenWithCustomGenerator()
    {
        $generator = $this->getMock('\\Commentar\\Security\\Generator');
        $generator->expects($this->any())
            ->method('generate')
            ->will($this->returnValue('Li4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLi4uLg'));

        $factory = $this->getMock('\\Commentar\\Security\\Generator\\Builder');
        $factory->expects($this->any())
            ->method('build')
            ->will($this->returnValue($generator));

        $csrfToken = new CsrfToken(
            $this->getMock('\\Commentar\\Security\\CsrfToken\\StorageMedium'),
            $factory,
            ['customGenerator']
        );

        $token = $csrfToken->getToken();

        $this->assertSame(174, strlen($token));
        $this->assertSame('TGk0dUxpNHVMaTR1TGk0dUxpNHVMaTR1TGk0dUxpNHVMaTR1TGk0dUxpNHVMaTR1TGk0dUxpNHVMaTR1TGk0dUxpNHVMaTR1TGk0dUxpNHVMaTR1TGk0dUxpNHVMaTR1TGk0dUxpNHVMaTR1TGk0dUxpNHVMaTR1TGk0dUxpNHVMZw', $token);
    }

    /**
     * @covers Commentar\Security\CsrfToken::__construct
     * @covers Commentar\Security\CsrfToken::getToken
     */
    public function testGetTokenInitialized()
    {
        $storage = $this->getMock('\\Commentar\\Security\\CsrfToken\\StorageMedium');
        $storage->expects($this->any())
            ->method('get')
            ->will($this->returnValue('foo'));

        $csrfToken = new CsrfToken(
            $storage,
            $this->getMock('\\Commentar\\Security\\Generator\\Builder')
        );

        $this->assertSame('foo', $csrfToken->getToken());
    }

    /**
     * @covers Commentar\Security\CsrfToken::__construct
     * @covers Commentar\Security\CsrfToken::getToken
     * @covers Commentar\Security\CsrfToken::generateToken
     * @covers Commentar\Security\CsrfToken::validate
     */
    public function testValidateGeneratedValid()
    {
        $storage = $this->getMock('\\Commentar\\Security\\CsrfToken\\StorageMedium');
        $storage->expects($this->any())
            ->method('get')
            ->will($this->returnValue('foo'));

        $generator = $this->getMock('\\Commentar\\Security\\Generator');
        $generator->expects($this->any())
            ->method('generate')
            ->will($this->returnValue('foo'));

        $factory = $this->getMock('\\Commentar\\Security\\Generator\\Builder');
        $factory->expects($this->any())
            ->method('build')
            ->will($this->returnValue($generator));

        $csrfToken = new CsrfToken(
            $storage,
            $factory,
            ['customGenerator']
        );

        $this->assertTrue($csrfToken->validate($csrfToken->getToken()));
    }

    /**
     * @covers Commentar\Security\CsrfToken::__construct
     * @covers Commentar\Security\CsrfToken::getToken
     * @covers Commentar\Security\CsrfToken::generateToken
     * @covers Commentar\Security\CsrfToken::validate
     */
    public function testValidateGeneratedInvalid()
    {
        $generator = $this->getMock('\\Commentar\\Security\\Generator');
        $generator->expects($this->any())
            ->method('generate')
            ->will($this->returnValue(str_repeat('x', 97)));

        $factory = $this->getMock('\\Commentar\\Security\\Generator\\Builder');
        $factory->expects($this->any())
            ->method('build')
            ->will($this->returnValue($generator));

        $csrfToken = new CsrfToken(
            $this->getMock('\\Commentar\\Security\\CsrfToken\\StorageMedium'),
            $factory,
            ['customGenerator']
        );
        $csrfToken->getToken();

        $this->assertFalse($csrfToken->validate('invalid'));
    }

    /**
     * @covers Commentar\Security\CsrfToken::__construct
     * @covers Commentar\Security\CsrfToken::getToken
     * @covers Commentar\Security\CsrfToken::validate
     */
    public function testValidateInitializedValid()
    {
        $storage = $this->getMock('\\Commentar\\Security\\CsrfToken\\StorageMedium');
        $storage->expects($this->any())
            ->method('get')
            ->will($this->returnValue('foo'));

        $csrfToken = new CsrfToken(
            $storage,
            $this->getMock('\\Commentar\\Security\\Generator\\Builder'),
            ['customGenerator']
        );

        $csrfToken->getToken();

        $this->assertTrue($csrfToken->validate('foo'));
    }

    /**
     * @covers Commentar\Security\CsrfToken::__construct
     * @covers Commentar\Security\CsrfToken::getToken
     * @covers Commentar\Security\CsrfToken::validate
     */
    public function testValidateInitializedInvalid()
    {
        $storage = $this->getMock('\\Commentar\\Security\\CsrfToken\\StorageMedium');
        $storage->expects($this->any())
            ->method('get')
            ->will($this->returnValue('foo'));

        $csrfToken = new CsrfToken(
            $storage,
            $this->getMock('\\Commentar\\Security\\Generator\\Builder'),
            ['customGenerator']
        );

        $csrfToken->getToken();

        $this->assertFalse($csrfToken->validate('invalid'));
    }

    /**
     * @covers Commentar\Security\CsrfToken::__construct
     * @covers Commentar\Security\CsrfToken::getToken
     * @covers Commentar\Security\CsrfToken::generateToken
     * @covers Commentar\Security\CsrfToken::regenerateToken
     */
    public function testRegenerateTokenSuccess()
    {
        $storage = $this->getMock('\\Commentar\\Security\\CsrfToken\\StorageMedium');
        $storage->expects($this->at(0))
            ->method('get')
            ->will($this->returnValue(str_repeat('f', 97)));
        $storage->expects($this->at(1))
            ->method('get')
            ->will($this->returnValue(str_repeat('b', 97)));

        $generator = $this->getMock('\\Commentar\\Security\\Generator');
        $generator->expects($this->at(0))
            ->method('generate')
            ->will($this->returnValue(str_repeat('f', 97)));
        $generator->expects($this->at(1))
            ->method('generate')
            ->will($this->returnValue(str_repeat('b', 97)));

        $factory = $this->getMock('\\Commentar\\Security\\Generator\\Builder');
        $factory->expects($this->any())
            ->method('build')
            ->will($this->returnValue($generator));

        $csrfToken = new CsrfToken(
            $storage,
            $factory,
            ['customGenerator']
        );

        $oldToken = $csrfToken->getToken();
        $csrfToken->regenerateToken();
        $newToken = $csrfToken->getToken();

        $this->assertInternalType('string', $newToken);

        $this->assertTrue($oldToken !== $newToken);
        $this->assertTrue($oldToken != $newToken);

        $this->assertSame(str_repeat('f', 97), $oldToken);
        $this->assertSame('YmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYmJiYg', $newToken);
    }

    /**
     * @covers Commentar\Security\CsrfToken::__construct
     * @covers Commentar\Security\CsrfToken::getToken
     * @covers Commentar\Security\CsrfToken::generateToken
     */
    public function testGenerateTokenWithUnsupportedAlgoFirst()
    {
        $generator = $this->getMock('\\Commentar\\Security\\Generator');
        $generator->expects($this->any())
            ->method('generate')
            ->will($this->returnValue(str_repeat('f', 97)));

        $factory = $this->getMock('\\Commentar\\Security\\Generator\\Builder');
        $factory->expects($this->at(0))
            ->method('build')
            ->will($this->throwException(new \Commentar\Security\Generator\UnsupportedAlgorithmException()));
        $factory->expects($this->at(1))
            ->method('build')
            ->will($this->returnValue($generator));

        $csrfToken = new CsrfToken(
            $this->getMock('\\Commentar\\Security\\CsrfToken\\StorageMedium'),
            $factory,
            ['invalid', 'valid']
        );

        $this->assertSame('ZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZg', $csrfToken->getToken());
    }

    /**
     * @covers Commentar\Security\CsrfToken::__construct
     * @covers Commentar\Security\CsrfToken::getToken
     * @covers Commentar\Security\CsrfToken::generateToken
     */
    public function testGenerateTokenWithUnsupportedAlgoLast()
    {
        $generator = $this->getMock('\\Commentar\\Security\\Generator');
        $generator->expects($this->any())
            ->method('generate')
            ->will($this->returnValue(str_repeat('f', 97)));

        $factory = $this->getMock('\\Commentar\\Security\\Generator\\Builder');
        $factory->expects($this->at(0))
            ->method('build')
            ->will($this->returnValue($generator));

        $csrfToken = new CsrfToken(
            $this->getMock('\\Commentar\\Security\\CsrfToken\\StorageMedium'),
            $factory,
            ['invalid', 'valid']
        );

        $this->assertSame('ZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZg', $csrfToken->getToken());
    }
}
