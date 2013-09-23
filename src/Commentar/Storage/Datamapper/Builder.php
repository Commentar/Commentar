<?php
/**
 * Interface for storage datamapper factories
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    Storage
 * @subpackage Datamapper
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\Storage\Datamapper;

/**
 * Interface for storage datamapper factories
 *
 * @category   Commentar
 * @package    Storage
 * @subpackage Datamapper
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Builder
{
    /**
     * Builds the requested datamapper
     *
     * @param string $name The name of the data mapper to build
     *
     * @return object The datamapper
     */
    public function build($name);
}
