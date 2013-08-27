<?php
/**
 * Interface for storage classes
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    Storage
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\Storage;

/**
 * Interface for storage classes
 *
 * @category   Commentar
 * @package    Storage
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Mechanism
{
    /**
     * Gets the comments based on the post/page id formatted as tree
     *
     * @param int|string $id The id of which to get the comments for
     *
     * @return array List of all the comments
     */
    public function getTree($id);

    /**
     * Gets the comments based on the post/page id formatted as sorted list
     *
     * @param int|string $id The id of which to get the comments for
     *
     * @return array List of all the comments
     */
    public function getBest($id);
}
