<?php
/**
 * Theme loader
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
class Theme
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
        $this->themePath = $themePath;
        $this->themes    = $themes;
    }

    /**
     * Loads the theme
     *
     * @return string The rendered theme
     */
    public function load()
    {
        return $this->loadTemplate('page.phtml');
    }

    /**
     * Loads a template in the theme
     *
     * @param string $filename The filename to load
     *
     * @return string The rendered template
     */
    public function loadTemplate($filename)
    {
        return $this->renderTemplate($this->getFirstMatchingFile($filename));
    }

    /**
     * Gets the first matching file
     *
     * The file will be searched in the themes in the sequence they are defined in the themes array at initialization
     *
     * @param string $filename The filename to search for
     *
     * @return string The filename found
     */
    private function getFirstMatchingFile($filename)
    {
        foreach ($this->themes as $theme) {
            if (!file_exists($this->getFilenameInTheme($filename, $theme))) {
                continue;
            }

            return $this->getFilenameInTheme($filename, $theme);
        }
    }

    /**
     * Renders a template
     *
     * @param string $filename The full filename to render
     *
     * @return string The rendered template
     */
    private function renderTemplate($filename)
    {
        ob_start();
        require $filename;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
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
        return $this->themePath . $theme . '/' . $filename;
    }
}
