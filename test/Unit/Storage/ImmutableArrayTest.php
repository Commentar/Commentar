<?php

namespace CommentarTest\Storage;

use Commentar\Storage\ImmutableArray;

class ImmutableArrayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Storage\ImmutableArray::__construct
     */
    public function testConstructCorrectInterface()
    {
        $array = new ImmutableArray();

        $this->assertInstanceOf('\\Commentar\\Storage\\KeyValueGetter', $array);
    }

    /**
     * @covers Commentar\Storage\ImmutableArray::__construct
     */
    public function testConstructCorrectInstance()
    {
        $array = new ImmutableArray();

        $this->assertInstanceOf('\\Commentar\\Storage\\ImmutableArray', $array);
    }

    /**
     * @covers Commentar\Storage\ImmutableArray::__construct
     * @covers Commentar\Storage\ImmutableArray::isKeyValid
     */
    public function testIsKeyValidInvalid()
    {
        $array = new ImmutableArray();

        $this->assertFalse($array->isKeyValid('foo'));
    }

    /**
     * @covers Commentar\Storage\ImmutableArray::__construct
     * @covers Commentar\Storage\ImmutableArray::isKeyValid
     */
    public function testIsKeyValidValid()
    {
        $array = new ImmutableArray(['foo' => 'bar']);

        $this->assertTrue($array->isKeyValid('foo'));
    }

    /**
     * @covers Commentar\Storage\ImmutableArray::__construct
     * @covers Commentar\Storage\ImmutableArray::get
     */
    public function testGetExists()
    {
        $array = new ImmutableArray(['foo' => 'bar']);

        $this->assertSame('bar', $array->get('foo'));
    }

    /**
     * @covers Commentar\Storage\ImmutableArray::__construct
     * @covers Commentar\Storage\ImmutableArray::get
     */
    public function testGetNotExistsDefaultValue()
    {
        $array = new ImmutableArray();

        $this->assertNull($array->get('foo'));
    }

    /**
     * @covers Commentar\Storage\ImmutableArray::__construct
     * @covers Commentar\Storage\ImmutableArray::get
     */
    public function testGetNotExistsCustomDefaultValue()
    {
        $array = new ImmutableArray();

        $this->assertSame('bar', $array->get('foo', 'bar'));
    }
}
