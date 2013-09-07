<?php
/**
 * Interface for generic factories to build services with an arbitrary number of arguments
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    ServiceBuilder
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\ServiceBuilder;

/**
 * Interface for generic factories to build services with an arbitrary number of arguments
 *
 * @category   Commentar
 * @package    ServiceBuilder
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Builder
{
    /**
     * Builds a service
     *
     * @param string $service   The service to build
     * @param array  $arguments List of arguments to created the instance of the service
     *
     * @return object                                            The service
     * @throws \Commentar\ServiceBuilder\InvalidServiceException When the service could not be loaded
     */
    public function build($service, array $arguments = []);
}
