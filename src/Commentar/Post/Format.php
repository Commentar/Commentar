<?php
/**
 * Interface for post formatters
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    Post
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\Post;

/**
 * Interface for post formatters
 *
 * @category   Commentar
 * @package    Post
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Format
{
    /**
     * Parses the content of the post and returns formatted and safe content
     *
     * @param string $content The content of the post
     *
     * @return string The parsed content
     */
    public function parse();
}
