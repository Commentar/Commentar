<?php
/**
 * Interface for resource loaders
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    Presentation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\Presentation;

/**
 * Interface for resource loaders
 *
 * @category   Commentar
 * @package    Presentation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Resource
{
    /**
     * Sets the correct header and loads the file
     *
     * @param string $filename The filename to check
     *
     * return string The contents of the file when it is valid
     */
    public function load($filename);
}
