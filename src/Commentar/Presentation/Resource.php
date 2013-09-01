<?php
/**
 * Resource loader
 *
 * This class is responsible for loading resources like images, stylesheet, fonts etc
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

use Commentar\Http\ResponseData;

/**
 * Resource loader
 *
 * @category   Commentar
 * @package    Presentation
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Resource implements ResourceLoader
{
    /**
     * @var array List of supported resource types
     */
    private $resourceTypes = [
        'js'   => 'application/javascript',
        'css'  => 'text/css',
        'ico'  => 'image/x-icon',
        'gif'  => 'image/gif',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'otf'  => 'application/x-font-otf',
        'eot'  => 'application/vnd.ms-fontobject',
        'svg'  => 'image/svg+xml',
        'ttf'  => 'application/x-font-ttf',
        'woff' => 'application/x-font-woff',
    ];

    /**
     * @var \Commentar\Http\ResponseData The HTTP response
     */
    private $response;

    /**
     * @var \Commentar\Presentation\ThemeLoader Instance of a theme loader
     */
    private $theme;

    /**
     * Creates instance
     *
     * @param \Commentar\Http\ResponseData        $response The HTTP response
     * @param \Commentar\Presentation\ThemeLoader $theme    Instance of a theme loader
     */
    public function __construct(ResponseData $response, ThemeLoader $theme)
    {
        $this->response = $response;
        $this->theme    = $theme;
    }

    /**
     * Checks whether the resource is supported by the loader
     *
     * @param string $filename The filename to check
     *
     * @return boolean True when the resource is valid
     */
    private function isValidResource($filename)
    {
        if (!file_exists($filename)) {
            return false;
        }

        $fileInfo = new \SplFileInfo($filename);

        return array_key_exists($fileInfo->getExtension(), $this->resourceTypes);
    }

    /**
     * Sets the correct header and loads the file
     *
     * @param string $filename The filename to check
     *
     * return string The contents of the file when it is valid
     */
    public function load($filename)
    {
        $filename = $this->theme->getFile($filename);

        if (!$this->isValidResource($filename)) {
            $this->response->setStatusCode('HTTP/1.1 404 Not Found');

            return;
        }

        $this->setContentType($filename);

        return $this->render($filename);
    }

    /**
     * Sets the correct content type for the file
     *
     * @param string $filename The filename based on which to set the content type
     */
    private function setContentType($filename)
    {
        $fileInfo = new \SplFileInfo($filename);

        $this->response->setContentType($this->resourceTypes[$fileInfo->getExtension()]);
    }

    /**
     * Renders the content of the resource
     *
     * @param string $filename The filename based on which to set the content type
     *
     * @return string The content of the resource
     */
    private function render($filename)
    {
        ob_start();
        require $filename;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}
