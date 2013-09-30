<?php
/**
 * Interface for service factories
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    Service
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\Service;

/**
 * Interface for service factories
 *
 * @category   Commentar
 * @package    Service
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Builder
{
    /**
     * Builds a service
     *
     * @param string $service   The service to build
     *
     * @return object                                            The service
     * @throws \Commentar\ServiceBuilder\InvalidServiceException When the service could not be loaded
     */
    public function build($service);
}
