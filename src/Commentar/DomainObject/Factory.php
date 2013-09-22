<?php
/**
 * Factory which creates domain objects
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
 * Factory which creates domain objects
 *
 * @category   Commentar
 * @package    DomainObject
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Factory implements Builder
{
    /**
     * @var string The namespace from which to load the domain objects
     */
    private $namespace;

    /**
     * Creates instance
     *
     * @param string $namespace The namespace from which to load the domain objects
     */
    public function __construct($namespace = '\\Commentar\\DomainObject')
    {
        $this->namespace = rtrim($namespace) . '\\';
    }

    /**
     * Builds the domain object
     *
     * @param string $name The domain object to build
     *
     * @return object The domain object
     */
    public function build($name)
    {
        $fullyQualifiedNamespace = $this->namespace . $name;

        return new $fullyQualifiedNamespace();
    }
}
