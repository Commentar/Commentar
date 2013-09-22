<?php
/**
 * Interface for factories which creates domain objects
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    DomainObject
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\DomainObject;

/**
 * Interface for factories which creates domain objects
 *
 * @category   Commentar
 * @package    DomainObject
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Builder
{
    /**
     * Builds the domain object
     *
     * @param string $name The domain object to build
     *
     * @return object The domain object
     */
    public function build($name);
}
