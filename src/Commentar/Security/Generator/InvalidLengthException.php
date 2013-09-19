<?php
/**
 * Exception which gets thrown when an the length of the generated "random" string doesn't match the required length
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    Security
 * @subpackage Generator
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\Security\Generator;

/**
 * Exception which gets thrown when an the length of the generated "random" string doesn't match the required length
 *
 * @category   Commentar
 * @package    Security
 * @subpackage Generator
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class InvalidLengthException extends \Exception
{
}
