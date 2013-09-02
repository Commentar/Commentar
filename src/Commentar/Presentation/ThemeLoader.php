<?php
/**
 * Theme loader interface
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
 * Theme loader interface
 *
 * @category   Commentar
 * @package    Presentation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface ThemeLoader
{
    /**
     * Gets the first matching file in the defined themes
     *
     * The file will be searched in the themes in the sequence they are defined in the themes array at initialization
     *
     * @param string $filename The filename to search for
     *
     * @return string                                       The filename found
     * @throws \Commentar\Presentation\InvalidFileException When the file could not be found in any of the themes
     */
    public function getFile($filename);
}
