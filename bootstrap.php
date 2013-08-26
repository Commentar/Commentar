<?php
/**
 * This bootstraps the Commentar application
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    0.0.1
 */
namespace Commentar;

use Commentar\Core\Autoloader,
    Commentar\Storage\ArrayStorage,
    Commentar\Http\Request,
    Commentar\Http\Response,
    Commentar\Presentation\Theme,
    Commentar\Presentation\ResourceLoader;

/**
 * Bootstrap the Commentar library
 */
require_once __DIR__ . '/src/Commentar/bootstrap.php';

/**
 * Setup autoloader for the demo
 */
$autoloader = new Autoloader(__NAMESPACE__, dirname(__DIR__));
$autoloader->register();

/**
 * Load the environment
 */
require_once __DIR__ . '/init.deployment.php';

/**
 * Prevent rendering of pages when on CLI
 */
if(php_sapi_name() === 'cli') {
    return;
}

/**
 * Setup the request object
 */
$request = new Request(
    new ArrayStorage($_GET),
    new ArrayStorage($_POST),
    new ArrayStorage($_SERVER),
    new ArrayStorage($_FILES)
);

/**
 * Setup the response object
 */
$response = new Response();

/**
 * Setup the resource loader
 */
$resourceLoader = new ResourceLoader($response);

/**
 * Setup the theme loader
 */
$theme = new Theme(__DIR__ . '/themes/', $resourceLoader);

/**
 * Load external resources (stylesheet, images etc)
 */
if ($request->isResource()) {
    $theme->loadResource($request->getPath());
} else {
    $theme->load($response);
}

echo $response->render();
