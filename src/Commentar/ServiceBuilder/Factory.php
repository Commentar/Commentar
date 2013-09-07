<?php
/**
 * Generic factory to build services with an arbitrary number of arguments
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
 * Generic factory to build services with an arbitrary number of arguments
 *
 * @category   Commentar
 * @package    ServiceBuilder
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Factory implements Builder
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
    public function build($service, array $arguments = [])
    {
        if (!class_exists($service)) {
            throw new InvalidServiceException('The service `' . $service . '` is invalid.');
        }

        $service = new \ReflectionClass($service);

        return $service->newInstanceArgs($arguments);
    }
}
