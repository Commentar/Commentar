<?php
/**
 * Bootstrap the tests
 *
 * PHP version 5.4
 *
 * @category   CommentarTest
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace CommentarTest;

date_default_timezone_set('Europe/Amsterdam');

session_start();

/**
 * Simple SPL autoloader for the CommentarTest libraries
 *
 * @param string $class The class name to load
 *
 * @return void
 */
spl_autoload_register(function ($class) {
    $nslen = strlen(__NAMESPACE__);
    if (substr($class, 0, $nslen) != __NAMESPACE__) {
        return;
    }
    $path = substr(str_replace('\\', '/', $class), $nslen);
    $path = __DIR__ . $path . '.php';
    if (file_exists($path)) {
        require $path;
    }
});

/**
 * Set the data directory for test data
 */
define('COMMENTAR_TEST_DATA_DIR', __DIR__ . '/Data');

/**
 * Simple function to easily get test data
 *
 * @param string $file Location of the file to load
 *
 * @return mixed The test data from the file
 */
function getTestDataFromFile($file)
{
    return require $file;
}

/**
 * Load the project's autoloader
 */
require_once __DIR__ . '/../src/Commentar/bootstrap.php';
