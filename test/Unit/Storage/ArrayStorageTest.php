<?php

namespace CommentarTest\Storage;

use Commentar\Storage\ArrayStorage;

class ArrayStorageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Storage\ArrayStorage::__construct
     */
    public function testConstructCorrectInterface()
    {
        $array = new ArrayStorage();

        $this->assertInstanceOf('\\Commentar\\Storage\\KeyValue', $array);
    }

    /**
     * @covers Commentar\Storage\ArrayStorage::__construct
     */
    public function testConstructCorrectInstance()
    {
        $array = new ArrayStorage();

        $this->assertInstanceOf('\\Commentar\\Storage\\ArrayStorage', $array);
    }

    /**
     * @covers Commentar\Storage\ArrayStorage::__construct
     * @covers Commentar\Storage\ArrayStorage::isKeyValid
     */
    public function testIsKeyValidInvalid()
    {
        $array = new ArrayStorage();

        $this->assertFalse($array->isKeyValid('foo'));
    }

    /**
     * @covers Commentar\Storage\ArrayStorage::__construct
     * @covers Commentar\Storage\ArrayStorage::set
     * @covers Commentar\Storage\ArrayStorage::isKeyValid
     */
    public function testIsKeyValidValid()
    {
        $array = new ArrayStorage(['foo' => 'bar']);

        $this->assertTrue($array->isKeyValid('foo'));
    }

    /**
     * @covers Commentar\Storage\ArrayStorage::__construct
     * @covers Commentar\Storage\ArrayStorage::get
     */
    public function testGetExists()
    {
        $array = new ArrayStorage(['foo' => 'bar']);

        $this->assertSame('bar', $array->get('foo'));
    }

    /**
     * @covers Commentar\Storage\ArrayStorage::__construct
     * @covers Commentar\Storage\ArrayStorage::get
     */
    public function testGetNotExistsDefaultValue()
    {
        $array = new ArrayStorage();

        $this->assertNull($array->get('foo'));
    }

    /**
     * @covers Commentar\Storage\ArrayStorage::__construct
     * @covers Commentar\Storage\ArrayStorage::get
     */
    public function testGetNotExistsCustomDefaultValue()
    {
        $array = new ArrayStorage();

        $this->assertSame('bar', $array->get('foo', 'bar'));
    }

    /**
     * @covers Commentar\Storage\ArrayStorage::__construct
     * @covers Commentar\Storage\ArrayStorage::get
     * @covers Commentar\Storage\ArrayStorage::set
     */
    public function testSet()
    {
        $array = new ArrayStorage();

        $array->set('foo', 'bar');

        $this->assertSame('bar', $array->get('foo'));
    }

    /**
     * @covers Commentar\Storage\ArrayStorage::__construct
     * @covers Commentar\Storage\ArrayStorage::get
     * @covers Commentar\Storage\ArrayStorage::set
     * @covers Commentar\Storage\ArrayStorage::delete
     */
    public function testDelete()
    {
        $array = new ArrayStorage();

        $array->set('foo', 'bar');
        $array->delete('foo');

        $this->assertNull($array->get('foo'));
    }
}
