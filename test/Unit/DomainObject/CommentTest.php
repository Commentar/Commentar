<?php

namespace CommentarTest\DomainObject;

use Commentar\DomainObject\Comment;

class CommentTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testConstructCorrectInstance()
    {
        $comment = new Comment();

        $this->assertInstanceOf('\\Commentar\\DomainObject\\Comment', $comment);
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     */
    public function testFillInvalidProperty()
    {
        $comment = new Comment();

        $this->setExpectedException('\\Commentar\\DomainObject\\InvalidPropertyException');

        $comment->fill(['undefinedProperty' => true]);
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     * @covers Commentar\DomainObject\Comment::setId
     * @covers Commentar\DomainObject\Comment::getId
     */
    public function testGetIdFilled()
    {
        $comment = new Comment();

        $comment->fill(['id' => 1]);

        $this->assertSame(1, $comment->getId());
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     * @covers Commentar\DomainObject\Comment::setId
     * @covers Commentar\DomainObject\Comment::getId
     */
    public function testGetIdCasted()
    {
        $comment = new Comment();

        $comment->fill(['id' => '1']);

        $this->assertSame(1, $comment->getId());
    }

    /**
     * @covers Commentar\DomainObject\Comment::getId
     */
    public function testGetIdDefault()
    {
        $comment = new Comment();

        $this->assertNull($comment->getId());
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     * @covers Commentar\DomainObject\Comment::setPostId
     * @covers Commentar\DomainObject\Comment::getPostId
     */
    public function testGetPostIdFilled()
    {
        $comment = new Comment();

        $comment->fill(['postId' => 1]);

        $this->assertSame(1, $comment->getPostId());
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     * @covers Commentar\DomainObject\Comment::setPostId
     * @covers Commentar\DomainObject\Comment::getPostId
     */
    public function testGetPostIdCasted()
    {
        $comment = new Comment();

        $comment->fill(['postId' => '1']);

        $this->assertSame(1, $comment->getPostId());
    }

    /**
     * @covers Commentar\DomainObject\Comment::getPostId
     */
    public function testGetPostIdDefault()
    {
        $comment = new Comment();

        $this->assertNull($comment->getPostId());
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     * @covers Commentar\DomainObject\Comment::setUser
     * @covers Commentar\DomainObject\Comment::getUser
     */
    public function testGetUserFilled()
    {
        $comment = new Comment();

        $comment->fill(['user' => $this->getMock('\\Commentar\\DomainObject\\User')]);

        $this->assertInstanceOf('\\Commentar\\DomainObject\\User', $comment->getUser());
    }

    /**
     * @covers Commentar\DomainObject\Comment::getUser
     */
    public function testGetUserDefault()
    {
        $comment = new Comment();

        $this->assertNull($comment->getUser());
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     * @covers Commentar\DomainObject\Comment::setParent
     * @covers Commentar\DomainObject\Comment::getParent
     */
    public function testGetParentFilled()
    {
        $comment = new Comment();

        $comment->fill(['parent' => 1]);

        $this->assertSame(1, $comment->getParent());
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     * @covers Commentar\DomainObject\Comment::setParent
     * @covers Commentar\DomainObject\Comment::getParent
     */
    public function testGetParentCasted()
    {
        $comment = new Comment();

        $comment->fill(['parent' => '1']);

        $this->assertSame(1, $comment->getParent());
    }

    /**
     * @covers Commentar\DomainObject\Comment::getParent
     */
    public function testGetParentDefault()
    {
        $comment = new Comment();

        $this->assertNull($comment->getParent());
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     * @covers Commentar\DomainObject\Comment::setContent
     * @covers Commentar\DomainObject\Comment::getContent
     */
    public function testGetContentFilled()
    {
        $comment = new Comment();

        $comment->fill(['content' => 'foo']);

        $this->assertSame('foo', $comment->getContent());
    }

    /**
     * @covers Commentar\DomainObject\Comment::getContent
     */
    public function testGetContentDefault()
    {
        $comment = new Comment();

        $this->assertNull($comment->getContent());
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     * @covers Commentar\DomainObject\Comment::setTimestamp
     * @covers Commentar\DomainObject\Comment::getTimestamp
     */
    public function testGetTimestampFilled()
    {
        $comment = new Comment();

        $comment->fill(['timestamp' => new \DateTime('2013-01-01 00:00:00')]);

        $timestamp = $comment->getTimestamp();
        $this->assertInstanceOf('\\DateTime', $timestamp);
        $this->assertSame('2013-01-01 00:00:00', $timestamp->format('Y-m-d H:i:s'));
    }

    /**
     * @covers Commentar\DomainObject\Comment::getTimestamp
     */
    public function testGetTimestampDefault()
    {
        $comment = new Comment();

        $this->assertNull($comment->getTimestamp());
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     * @covers Commentar\DomainObject\Comment::setUpdated
     * @covers Commentar\DomainObject\Comment::getUpdated
     */
    public function testGetUpdatedFilled()
    {
        $comment = new Comment();

        $comment->fill(['updated' => new \DateTime('2013-01-01 00:00:00')]);

        $updated = $comment->getUpdated();
        $this->assertInstanceOf('\\DateTime', $updated);
        $this->assertSame('2013-01-01 00:00:00', $updated->format('Y-m-d H:i:s'));
    }

    /**
     * @covers Commentar\DomainObject\Comment::getUpdated
     */
    public function testGetUpdatedDefault()
    {
        $comment = new Comment();

        $this->assertNull($comment->getUpdated());
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     * @covers Commentar\DomainObject\Comment::setScore
     * @covers Commentar\DomainObject\Comment::getScore
     */
    public function testGetScoreFilled()
    {
        $comment = new Comment();

        $comment->fill(['score' => 1]);

        $this->assertSame(1, $comment->getScore());
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     * @covers Commentar\DomainObject\Comment::setScore
     * @covers Commentar\DomainObject\Comment::getScore
     */
    public function testGetScoreCasted()
    {
        $comment = new Comment();

        $comment->fill(['score' => '1']);

        $this->assertSame(1, $comment->getScore());
    }

    /**
     * @covers Commentar\DomainObject\Comment::getScore
     */
    public function testGetScoreDefault()
    {
        $comment = new Comment();

        $this->assertSame(0, $comment->getScore());
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     * @covers Commentar\DomainObject\Comment::setIsReviewed
     * @covers Commentar\DomainObject\Comment::isReviewed
     */
    public function testIsReviewedFilled()
    {
        $comment = new Comment();

        $comment->fill(['isReviewed' => true]);

        $this->assertSame(true, $comment->isReviewed());
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     * @covers Commentar\DomainObject\Comment::setIsReviewed
     * @covers Commentar\DomainObject\Comment::isReviewed
     */
    public function testIsReviewedCasted()
    {
        $comment = new Comment();

        $comment->fill(['isReviewed' => 1]);

        $this->assertSame(true, $comment->isReviewed());
    }

    /**
     * @covers Commentar\DomainObject\Comment::isReviewed
     */
    public function testIsReviewedDefault()
    {
        $comment = new Comment();

        $this->assertFalse($comment->isReviewed());
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     * @covers Commentar\DomainObject\Comment::setIsModerated
     * @covers Commentar\DomainObject\Comment::isModerated
     */
    public function testIsModeratedFilled()
    {
        $comment = new Comment();

        $comment->fill(['isModerated' => true]);

        $this->assertSame(true, $comment->isModerated());
    }

    /**
     * @covers Commentar\DomainObject\Comment::fill
     * @covers Commentar\DomainObject\Comment::setIsModerated
     * @covers Commentar\DomainObject\Comment::isModerated
     */
    public function testIsModeratedCasted()
    {
        $comment = new Comment();

        $comment->fill(['isModerated' => 1]);

        $this->assertSame(true, $comment->isModerated());
    }

    /**
     * @covers Commentar\DomainObject\Comment::isModerated
     */
    public function testIsModeratedDefault()
    {
        $comment = new Comment();

        $this->assertFalse($comment->isModerated());
    }
}
