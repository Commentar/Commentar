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

use Commentar\Core\Autoloader;
use Commentar\Storage\ArrayStorage;
use Commentar\Http\RequestData;
use Commentar\Http\Request;
use Commentar\Http\Response;
use Commentar\ServiceBuilder\Factory as ServiceFactory;
use Commentar\Router\RouteFactory;
use Commentar\Router\Router;
use Commentar\Router\FrontController;
use Commentar\Presentation\Theme;
use Commentar\Presentation\Resource;

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
 * Setup storage mechanism
 *
 * @todo The entire storage mechanism inclusion should be done correctly instead of this quick fix
 */
$storage = new \Commentar\Storage\Dummy();

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
 * Setup the service factory
 */
$serviceFactory = new ServiceFactory();

/**
 * Setup the theme
 */
$theme    = new Theme(__DIR__ . '/themes/');
$resource = new Resource($response, $theme);

/**
 * Setup the router
 */
$routeFactory = new RouteFactory();
$router       = new Router($routeFactory);

$router->get('comments', '#^/comments/([^/]+)/?$#', function(RequestData $request) use ($storage, $theme, $serviceFactory) {
    $view = new \Commentar\Presentation\View\CommentList($theme, $serviceFactory, ['comments' => $storage->getTree($request->param(0))]);

    return $view->renderPage();
});

$router->get('resources', '#\.(js|css|ico|gif|jpg|jpeg|otf|eot|svg|ttf|woff)$#', function(RequestData $request) use ($resource) {
    return $resource->load($request->getPath());
});

$router->get('404', '#^/not-found/?#', function(RequestData $request) use ($theme, $serviceFactory) {
    $view = new \Commentar\Presentation\View\NotFound($theme, $serviceFactory);

    return $view->renderPage();
});

/**
 * Run the app
 */
$frontcontroller = new FrontController($request, $response, $router);
$frontcontroller->dispatch();

/**
 * Render the content
 */
echo $response->render();
