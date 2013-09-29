<?php
/**
 * Service for comment(s)
 *
 * This service acts like a proxy in between the the application and the chosen datamapper(s) / domainobject(s)
 * combination.
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    Service
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\Service;

use Commentar\DomainObject\Builder as DomainObjectBuilder;
use Commentar\Storage\Datamapper\Builder as DatamapperBuilder;
use Commentar\Http\RequestData;
use Commentar\DomainObject\User as UserDomainObject;

/**
 * Service for comment(s)
 *
 * @category   Commentar
 * @package    Service
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Comment
{
    /**
     * @var \Commentar\DomainObject\Builder Instance of a domain object factory
     */
    private $domainObjectFactory;

    /**
     * @var \Commentar\Storage\Datamapper\Builder Instance of a datamapper factory
     */
    private $datamapperFactory;

    /**
     * Creates instance
     *
     * @param \Commentar\DomainObject\Builder       $domainObjectFactory Instance of a domain object factory
     * @param \Commentar\Storage\Datamapper\Builder $datamapperFactory   Instance of a datamapper factory
     */
    public function __construct(DomainObjectBuilder $domainObjectFactory, DatamapperBuilder $datamapperFactory)
    {
        $this->domainObjectFactory = $domainObjectFactory;
        $this->datamapperFactory   = $datamapperFactory;
    }

    /**
     * Gets the comment tree
     *
     * @param int $id The id of the thread of which to get the comments for
     *
     * @return array The comments tree
     */
    public function getTree($id)
    {
        $commentMapper = $this->datamapperFactory->build('Comment');
        $comments = $commentMapper->fetchByPostId($id);

        if (!count($comments)) {
            return [];
        }

        $commentCollection = [];
        foreach ($comments as $comment) {
            $userMapper = $this->datamapperFactory->build('User');
            $user = $this->domainObjectFactory->build('User');
            $userMapper->fetchById($user, $comment['userId']);

            $commentCollection[$comment['id']] = $this->domainObjectFactory->build('Comment');

            $commentData = [
                'id'          => $comment['id'],
                'postId'      => $comment['postId'],
                'user'        => $user,
                'parent'      => $comment['parent'],
                'content'     => $comment['content'],
                'timestamp'   => $comment['timestamp'],
                'score'       => $comment['score'],
                'isReviewed'  => $comment['isReviewed'],
                'isModerated' => $comment['isModerated'],
                'children'    => [],
            ];

            if ($comment['updated'] !== null) {
                $commentData['updated'] = $comment['updated'];
            }

            $commentCollection[$comment['id']]->fill($commentData);
        }

        return $this->convertFlatToTree($commentCollection);
    }

    /**
     * Converts a flat array of comments to a comment tree
     *
     * @param array $comments The flat array of comments
     *
     * @return array The multidimensional array of comments
     */
    private function convertFlatToTree(array $comments)
    {
        $commentTree = [];

        $reversedComments = array_reverse($comments, true);

        $replies = [];

        foreach ($reversedComments as $id => $comment) {
            if (array_key_exists($comment->getId(), $replies)) {
                $comment->fill(['children' => array_reverse($replies[$comment->getId()], true)]);
                unset($replies[$comment->getId()]);
            }

            if ($comment->isReply()) {
                $replies[$comment->getParent()][] = $comment;
            } else {
                $commentTree[] = $comment;
            }
        }

        return array_reverse($commentTree, true);
    }

    /**
     * Creates the storage for a thread
     *
     * @param int $id The id iof the thread for which to create the storage
     */
    public function createStorage($id)
    {
        $commentMapper = $this->datamapperFactory->build('Comment');

        $commentMapper->createStore($id);
    }

    /**
     * Adds a comment to the storage
     *
     * @param \Commentar\Http\RequestData  $request The HTTP request data
     * @param \Commentar\DomainObject\User $user    The user domain object
     */
    public function post(RequestData $request, UserDomainObject $user)
    {
        $comment = $this->domainObjectFactory->build('Comment');
        $comment->fill([
            'postId'      => $request->param(0),
            'user'        => $user,
            'content'     => $request->post('comment'),
            'timestamp'   => new \DateTime('now'),
            'isReviewed'  => true,
            'isModerated' => false,
        ]);

        if ($request->param(1)) {
            $comment->fill(['parent' => $request->param(1)]);
        }

        $commentMapper = $this->datamapperFactory->build('Comment');
        $commentMapper->persist($comment);
    }
}
