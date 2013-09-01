<?php
/**
 * Theme loader
 *
 * This class is responsible for loading files from the defined themes. It will try to load a specific file in all the
 * defined themes. If the file is found in a theme the filename will be returned.
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
 * Theme loader
 *
 * @category   Commentar
 * @package    Presentation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Theme implements ThemeLoader
{
    /**
     * @var string The path to the themes directory
     */
    private $themePath;

    /**
     * @var array List of themes
     */
    private $themes = [];

    /**
     * Creates instance
     *
     * @param string $themePath The base path of the themes
     * @param array  $themes    List of the themes
     */
    public function __construct($themePath, array $themes = ['commentar'])
    {
        $this->themePath = rtrim($themePath, '/');
        $this->themes    = $themes;
    }

    /**
     * Gets the first matching file in the defined themes
     *
     * The file will be searched in the themes in the sequence they are defined in the themes array at initialization
     *
     * @param string $filename The filename to search for
     *
     * @return string The filename found
     * @throws \Commentar\Presentation\InvalidFileException When the file could not be found in any of the themes
     */
    public function getFile($filename)
    {
        foreach ($this->themes as $theme) {
            if (!file_exists($this->getFilenameInTheme($filename, $theme))) {
                continue;
            }

            return $this->getFilenameInTheme($filename, $theme);
        }

        throw new InvalidFileException(
            'No file with filename `' . $filename . '` could be found in the active themes (`' . implode(', ', $this->themes) . '`)'
        );
    }

    /**
     * Gets the full filename based on the base filename and the theme
     *
     * @param string $filename The base filename
     * @param string $theme    The theme
     *
     * @return string The full filename
     */
    private function getFilenameInTheme($filename, $theme)
    {
        return $this->themePath . '/' . $theme . '/' . $filename;
    }
}
