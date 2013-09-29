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
use Commentar\Auth\User;

/**
 * Bootstrap the Commentar library
 */
require_once __DIR__ . '/src/Commentar/bootstrap.php';

/**
 * Start the session
 */
session_start();

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
 * Setup authentication
 */
$auth = new User($_SESSION);

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
$resource = new Resource($request, $response, $theme);

/**
 * Setup the router
 */
$routeFactory = new RouteFactory();
$router       = new Router($routeFactory);

$router->get('comments', '#^/comments/([\d]+)/?$#', function(RequestData $request) use ($theme, $serviceFactory) {
    $domainObjectFactory = new \Commentar\DomainObject\Factory();
    //$datamapperFactory   = new \Commentar\Storage\Json\Factory(__DIR__ . '/vendor/commentar/json-storage/data');
    $datamapperFactory   = new \Commentar\Storage\Dummy\Factory();
    $commentService      = new \Commentar\Service\Comment($domainObjectFactory, $datamapperFactory);

    try {
        $commentTree = $commentService->getTree($request->param(0));

        $view = new \Commentar\Presentation\View\CommentOverview($theme, $serviceFactory, [
            'comments' => $commentTree,
            'id'       => $request->param(0),
        ]);

        return $view->renderPage();
    } catch(\Commentar\Storage\InvalidStorageException $e) {
        header('Location: ' . $request->getBaseUrl() . '/create/' . $request->param(0));
        exit;
    }
});

$router->get('create', '#^/create/([\d]+)/?#', function(RequestData $request) use ($theme, $serviceFactory, $auth) {
    if ($auth->isLoggedIn() && $auth->isAdmin()) {
        $view = new \Commentar\Presentation\View\Create($theme, $serviceFactory, [
            'returnUrl' => '/comments/' . $request->param(0),
            'id'        => $request->param(0),
        ]);

        return $view->renderPage();
    } else {
        $view = new \Commentar\Presentation\View\Login($theme, $serviceFactory, ['returnUrl' => '/comments/' . $request->param(0)]);

        return $view->renderPage();
    }
});

$router->post('create', '#^/create/([\d]+)$#', function(RequestData $request) use ($auth) {
    if (!$auth->isLoggedIn() || !$auth->isAdmin()) {
        header('Location: ' . $request->getBaseUrl() . '/create/' . $request->getParam(0));
        exit;
    }

    $domainObjectFactory = new \Commentar\DomainObject\Factory();
    //$datamapperFactory   = new \Commentar\Storage\Json\Factory(__DIR__ . '/vendor/commentar/json-storage/data');
    $datamapperFactory   = new \Commentar\Storage\Dummy\Factory();
    $commentService      = new \Commentar\Service\Comment($domainObjectFactory, $datamapperFactory);

    $commentService->createStorage($request->param(0));

    header('Location: ' . $request->getBaseUrl() . $request->post('returnUrl'));
    exit;
});

$router->get('login', '#^/login/?$#', function(RequestData $request) use ($theme, $serviceFactory) {
    $view = new \Commentar\Presentation\View\Login($theme, $serviceFactory);

    return $view->renderPage();
});

$router->post('login', '#^/login/?$#', function(RequestData $request) use ($theme, $serviceFactory, $auth) {
    $domainObjectFactory = new \Commentar\DomainObject\Factory();
    //$datamapperFactory   = new \Commentar\Storage\Json\Factory(__DIR__ . '/vendor/commentar/json-storage/data');
    $datamapperFactory   = new \Commentar\Storage\Dummy\Factory();
    $userService         = new \Commentar\Service\User($domainObjectFactory, $datamapperFactory);

    if ($userService->login($request, $auth)) {
        $_SESSION['commentar_user'] = $auth->getUserForSession();
        header('Location: ' . $request->getBaseUrl() . $request->post('returnUrl'));
        exit;
    }

    $view = new \Commentar\Presentation\View\Login($theme, $serviceFactory, [
        'username'  => $request->post('username'),
        'returnUrl' => $request->post('returnUrl'),
        'error'     => 'Invalid credentials',
    ]);

    return $view->renderPage();
});

$router->post('post', '#^/comments/([\d]+)/post/?$#', function(RequestData $request) use ($theme, $serviceFactory, $auth) {
    $domainObjectFactory = new \Commentar\DomainObject\Factory();
    //$datamapperFactory   = new \Commentar\Storage\Json\Factory(__DIR__ . '/vendor/commentar/json-storage/data');
    $datamapperFactory   = new \Commentar\Storage\Dummy\Factory();
    $commentService      = new \Commentar\Service\Comment($domainObjectFactory, $datamapperFactory);

    $commentService->post($request, $auth->getUser());

    header('Location: ' . $request->getBaseUrl() . $request->post('returnUrl'));
    exit;
});

$router->get('replyForm', '#^/comments/([\d]+)/reply/([\d]+)/?$#', function(RequestData $request) use ($theme, $serviceFactory) {
    $view = new \Commentar\Presentation\View\CommentForm($theme, $serviceFactory, [
        'id'     => $request->param(0),
        'parent' => $request->param(1),
    ]);

    return $view->renderTemplate();
});

$router->post('postReply', '#^/comments/([\d]+)/reply/([\d]+)/?$#', function(RequestData $request) use ($theme, $serviceFactory, $auth) {
    $domainObjectFactory = new \Commentar\DomainObject\Factory();
    //$datamapperFactory   = new \Commentar\Storage\Json\Factory(__DIR__ . '/vendor/commentar/json-storage/data');
    $datamapperFactory   = new \Commentar\Storage\Dummy\Factory();
    $commentService      = new \Commentar\Service\Comment($domainObjectFactory, $datamapperFactory);

    $commentService->post($request, $auth->getUser());

    header('Location: ' . $request->getBaseUrl() . $request->post('returnUrl'));
    exit;
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
