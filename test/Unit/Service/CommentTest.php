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
    public function testGetTreeEmpty()
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

    /**
     * @covers Commentar\Service\Comment::__construct
     * @covers Commentar\Service\Comment::getTree
     */
    public function testGetTree()
    {
        $comments = [
            1 => [
                'id'          => 1,
                'postId'      => 1,
                'userId'      => 21,
                'parent'      => null,
                'content'     => 'My first comment',
                'timestamp'   => new \DateTime('2013-01-01 00:00:00'),
                'score'       => 1,
                'isReviewed'  => true,
                'isModerated' => false,
                'updated'     => null,
            ],
            2 => [
                'id'          => 2,
                'postId'      => 1,
                'userId'      => 12,
                'parent'      => null,
                'content'     => 'My second comment',
                'timestamp'   => new \DateTime('2013-03-01 00:00:00'),
                'score'       => 10,
                'isReviewed'  => true,
                'isModerated' => false,
                'updated'     => null,
            ],
        ];

        $commentMapper = $this->getMock('\\Commentar\\Storage\\Datamapper\\CommentMappable');
        $commentMapper->expects($this->any())
            ->method('fetchByPostId')
            ->will($this->returnValue($comments));

        $userMappers = [];
        $i = 0;
        foreach ($comments as $comment) {
            $userMappers[$i] = $this->getMock('\\Commentar\\Storage\\Datamapper\\UserMappable');
            $user = new \Commentar\DomainObject\User();
            $user->fill([
                'id'       => $comment['userId'],
                'username' => 'user_' . $comment['userId'],
            ]);
            $userMappers[$i]->expects($this->any())
                ->method('fetchById')
                ->will($this->returnValue($user));

            $i++;
        }

        $datamapperFactory = $this->getMock('\\Commentar\\Storage\\Datamapper\\Builder');
        $datamapperFactory->expects($this->at(0))
            ->method('build')
            ->will($this->returnValue($commentMapper));
        $datamapperFactory->expects($this->at(1))
            ->method('build')
            ->will($this->returnValue($userMappers[0]));
        $datamapperFactory->expects($this->at(2))
            ->method('build')
            ->will($this->returnValue($userMappers[1]));

        $domainObjectFactory = $this->getMock('\\Commentar\\DomainObject\\Builder');
        $domainObjectFactory->expects($this->at(0))
            ->method('build')
            ->will($this->returnValue(new \Commentar\DomainObject\User()));
        $domainObjectFactory->expects($this->at(1))
            ->method('build')
            ->will($this->returnValue(new \Commentar\DomainObject\Comment()));
        $domainObjectFactory->expects($this->at(2))
            ->method('build')
            ->will($this->returnValue(new \Commentar\DomainObject\User()));
        $domainObjectFactory->expects($this->at(3))
            ->method('build')
            ->will($this->returnValue(new \Commentar\DomainObject\Comment()));

        $comment = new Comment($domainObjectFactory, $datamapperFactory);

        $this->assertSame(2, count($comment->getTree(1)));
    }

    /**
     * @covers Commentar\Service\Comment::__construct
     * @covers Commentar\Service\Comment::getTree
     */
    public function testGetTreeWithUpdatedComment()
    {
        $comments = [
            1 => [
                'id'          => 1,
                'postId'      => 1,
                'userId'      => 21,
                'parent'      => null,
                'content'     => 'My first comment',
                'timestamp'   => new \DateTime('2013-01-01 00:00:00'),
                'score'       => 1,
                'isReviewed'  => true,
                'isModerated' => false,
                'updated'     => new \DateTime('2012-01-01 00:00:00'),
            ],
        ];

        $commentMapper = $this->getMock('\\Commentar\\Storage\\Datamapper\\CommentMappable');
        $commentMapper->expects($this->any())
            ->method('fetchByPostId')
            ->will($this->returnValue($comments));

        $userMappers = [];
        $i = 0;
        foreach ($comments as $comment) {
            $userMappers[$i] = $this->getMock('\\Commentar\\Storage\\Datamapper\\UserMappable');
            $user = new \Commentar\DomainObject\User();
            $user->fill([
                'id'       => $comment['userId'],
                'username' => 'user_' . $comment['userId'],
            ]);
            $userMappers[$i]->expects($this->any())
                ->method('fetchById')
                ->will($this->returnValue($user));

            $i++;
        }

        $datamapperFactory = $this->getMock('\\Commentar\\Storage\\Datamapper\\Builder');
        $datamapperFactory->expects($this->at(0))
            ->method('build')
            ->will($this->returnValue($commentMapper));
        $datamapperFactory->expects($this->at(1))
            ->method('build')
            ->will($this->returnValue($userMappers[0]));

        $domainObjectFactory = $this->getMock('\\Commentar\\DomainObject\\Builder');
        $domainObjectFactory->expects($this->at(0))
            ->method('build')
            ->will($this->returnValue(new \Commentar\DomainObject\User()));
        $domainObjectFactory->expects($this->at(1))
            ->method('build')
            ->will($this->returnValue(new \Commentar\DomainObject\Comment()));

        $comment = new Comment($domainObjectFactory, $datamapperFactory);

        $this->assertSame(1, count($comment->getTree(1)));
    }

    /**
     * @covers Commentar\Service\Comment::__construct
     * @covers Commentar\Service\Comment::createStorage
     */
    public function testCreateStorage()
    {
        $dataMapper = $this->getMock('\\Commentar\\Storage\\Datamapper\\CommentMappable');
        $dataMapper->expects($this->once())
            ->method('createStore')
            ->will($this->returnCallback(function($id) {
                \PHPUnit_Framework_Assert::assertSame(1, $id);
            }));

        $datamapperFactory = $this->getMock('\\Commentar\\Storage\\Datamapper\\Builder');
        $datamapperFactory->expects($this->once())
            ->method('build')
            ->will($this->returnValue($dataMapper));

        $comment = new Comment(
            $this->getMock('\\Commentar\\DomainObject\\Builder'),
            $datamapperFactory
        );

        $this->assertNull($comment->createStorage(1));
    }

    /**
     * @covers Commentar\Service\Comment::__construct
     * @covers Commentar\Service\Comment::post
     */
    public function testPost()
    {
        $domainObjectFactory = $this->getMock('\\Commentar\\DomainObject\\Builder');
        $domainObjectFactory->expects($this->at(0))
            ->method('build')
            ->will($this->returnValue(new \Commentar\DomainObject\User()));
        $domainObjectFactory->expects($this->at(1))
            ->method('build')
            ->will($this->returnValue(new \Commentar\DomainObject\Comment()));

        $dataMapper = $this->getMock('\\Commentar\\Storage\\Datamapper\\CommentMappable');
        $dataMapper->expects($this->once())
            ->method('persist')
            ->will($this->returnValue(null));

        $datamapperFactory = $this->getMock('\\Commentar\\Storage\\Datamapper\\Builder');
        $datamapperFactory->expects($this->once())
            ->method('build')
            ->will($this->returnValue($dataMapper));

        $comment = new Comment($domainObjectFactory, $datamapperFactory);

        $request = $this->getMock('\\Commentar\\Http\\RequestData');
        $request->expects($this->any())
            ->method('param')
            ->will($this->returnValue(1));
        $request->expects($this->any())
            ->method('post')
            ->will($this->returnValue('My awesome post'));

        $this->assertNull($comment->post($request));
    }
}
