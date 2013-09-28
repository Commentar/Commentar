<?php
/**
 * Comment domain object
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    DomainObject
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\DomainObject;

/**
 * Comment domain object
 *
 * @category   Commentar
 * @package    DomainObject
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Comment
{
    /**
     * @var int The id of the user
     */
    protected $id;

    /**
     * @var int The id of the post to which the comment belongs
     */
    protected $postId;

    /**
     * @var \Commentar\DomainObject\User The user who posted the comment
     */
    protected $user;

    /**
     * @var null|int The id of the parent
     */
    protected $parent;

    /**
     * @var string The content of the comment
     */
    protected $content;

    /**
     * @var \DateTime The timestamp
     */
    protected $timestamp;

    /**
     * @var null|\DateTime Get the timestamp when the comment was last updated
     */
    protected $updated;

    /**
     * @var int The score of the comment
     */
    protected $score = 0;

    /**
     * @var boolean Whether the comment has been reviewed
     */
    protected $isReviewed = false;

    /**
     * @var boolean Whether the comment has been moderated
     */
    protected $isModerated = false;

    /**
     * @var array List of the children of the comment
     */
    protected $children = [];

    /**
     * Fills the object with data
     *
     * @param array $data The data used to fill the object
     *
     * @throws \Commentar\DomainObject\InvalidPropertyException When trying to fill an undefined property
     */
    public function fill(array $data)
    {
        foreach ($data as $name => $value) {
            if (!property_exists($this, $name)) {
                throw new InvalidPropertyException('Trying to fill an invalid property (`' . $name . '`).');
            }

            $setter = 'set' . ucfirst(strtolower($name));
            $this->$setter($value);
        }
    }

    /**
     * Sets the id of the comment
     *
     * @param int $id The id of the comment
     */
    protected function setId($id)
    {
        $this->id = (int) $id;
    }

    /**
     * Gets the id of the comment
     *
     * @return int The id of the comment
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the id of the post to which the comment belongs to
     *
     * @param int $id The id of the post to which the comment belongs to
     */
    protected function setPostId($postId)
    {
        $this->postId = (int) $postId;
    }

    /**
     * Gets the id of the post to which the comment belongs to
     *
     * @return int The id of the post to which the comment belongs to
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Sets the user
     *
     * @param \Commentar\DomainObject\User The user
     */
    protected function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * Gets the user
     *
     * @return \Commentar\DomainObject\User The user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Sets the id of the parent comment if any
     *
     * @param int $parent The optional id of the parent
     */
    protected function setParent($parent)
    {
        $this->parent = (int) $parent;
    }

    /**
     * Gets the id of the parent comment
     *
     * @return null|int The parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * CHeck whether the comment is posted on the root level (i.e. no reply)
     *
     * @return boolean true when the comment is a reply
     */
    public function isReply()
    {
        return $this->parent != 0;
    }

    /**
     * Sets the content of the comment
     *
     * @param string $content The content of the comment
     */
    protected function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Gets the content of the comment
     *
     * @return string The content of the comment
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the timestamp of the comment
     *
     * @param \DateTime $timestamp The timestamp of the comment
     */
    protected function setTimestamp(\DateTime $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * Gets the timestamp of the comment
     *
     * @return \DateTime The timestamp of the comment
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Sets the timestamp of when the comment is last updated
     *
     * @param \DateTime $updated The timestamp of when the comment is last updated
     */
    protected function setUpdated(\DateTime $updated)
    {
        $this->updated = $updated;
    }

    /**
     * Gets the timestamp of when the comment is last updated
     *
     * @return \DateTime The timestamp of when the comment is last updated
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Sets the score of the comment
     *
     * @param int $score The score of the comment
     */
    protected function setScore($score)
    {
        $this->score = (int) $score;
    }

    /**
     * Gets the score of the comment
     *
     * @return int The score of the comment
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Sets the reviewed status of the comment
     *
     * @param boolean $isReviewed Whether the comment is reviewed
     */
    protected function setIsReviewed($isReviewed)
    {
        $this->isReviewed = (bool) $isReviewed;
    }

    /**
     * Gets the reviewed status of the comment
     *
     * @return boolean Whether the comment is reviewed
     */
    public function isReviewed()
    {
        return $this->isReviewed;
    }

    /**
     * Sets the moderation status of the comment
     *
     * @param boolean $isModerated Whether the comment is moderated
     */
    protected function setIsModerated($isModerated)
    {
        $this->isModerated = (bool) $isModerated;
    }

    /**
     * Gets the moderation status of the comment
     *
     * @return boolean Whether the comment is moderated
     */
    public function isModerated()
    {
        return $this->isModerated;
    }

    /**
     * Sets the children of the comment
     *
     * @param array $children The children of the comment
     */
    protected function setChildren(array $children)
    {
        $this->children = $children;
    }

    /**
     * Gets the children of the comment
     *
     * @return array The children of the comment
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Checks whether the comment has children
     *
     * @return boolean True when the comment has children
     */
    public function hasChildren()
    {
        return !empty($this->children);
    }
}
