<?php
/**
 * Interface for generator factories
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
 * Interface for generator factories
 *
 * @category   Commentar
 * @package    Security
 * @subpackage Generator
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Builder
{
    /**
     * Builds a random string generator
     *
     * @param string $class The fully qualified class name
     *
     * @return \Commentar\Security\Generator The random string generator requested
     * @throws \Commentar\Security\Generator\InvalidGeneratorException If the generator can not be loaded
     */
    public function build($class);
}
