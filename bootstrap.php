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

require __DIR__ . '/app/templates/themes/commentar/page.phtml';
