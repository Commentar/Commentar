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
class ResourceLoader implements Resource
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
     * Creates instance
     *
     * @param \Commentar\Http\ResponseData $response The HTTP response
     */
    public function __construct(ResponseData $response)
    {
        $this->response = $response;
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
        if (!$this->isValidResource($filename)) {
            $this->response->setStatusCode('HTTP/1.1 404 Not Found');

            return;
        }

        $fileInfo = new \SplFileInfo($filename);

        $this->response->SetContentType($this->resourceTypes[$fileInfo->getExtension()]);

        ob_start();
        require $filename;
        $content = ob_get_contents();
        ob_end_clean();

        $this->response->setBody($content);
    }
}
