<?php

namespace CommentarTest\Unit\Service;

use Commentar\Service\Comment;

//use Commentar\DomainObject\Builder as DomainObjectBuilder;
//use Commentar\Storage\Datamapper\Builder as DatamapperBuilder;
//use Commentar\Http\RequestData;

class CommentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Commentar\Service\Comment::__construct
     */
    public function testConstructCorrectInstance()
    {
        $comment = new Comment(
            $this->getMock('\\Commentar\\DomainObject\\Builder'),
            $this->getMock('\\Commentar\\Storage\\Datamapper\\Builder')
        );

        $this->assertInstanceOf('\\Commentar\\Service\\Comment', $comment);
    }

    /**
     * @covers Commentar\Service\Comment::__construct
     * @covers Commentar\Service\Comment::getTree
     */
    public function testTreeEmpty()
    {
        $datamapper = $this->getMock('\\Commentar\\Storage\\Datamapper\\CommentMappable');
        $datamapper->expects($this->any())
            ->method('fetchByPostId')
            ->will($this->returnValue([]));

        $datamapperFactory = $this->getMock('\\Commentar\\Storage\\Datamapper\\Builder');
        $datamapperFactory->expects($this->any())
            ->method('build')
            ->will($this->returnValue($datamapper));

        $comment = new Comment(
            $this->getMock('\\Commentar\\DomainObject\\Builder'),
            $datamapperFactory
        );

        $this->assertSame([], $comment->getTree(1));
    }
}
