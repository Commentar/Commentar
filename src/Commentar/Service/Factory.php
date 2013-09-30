<?php
/**
 * Service factory
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

use Commentar\DomainObject\Builder as DomainObjectBuilder;
use Commentar\Storage\Datamapper\Builder as DatamapperBuilder;
use Commentar\ServiceBuilder\InvalidServiceException;

/**
 * Service factory
 *
 * @category   Commentar
 * @package    Service
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Factory implements Builder
{
    /**
     * @var \Commentar\DomainObject\Builder Instance of a domain object factory
     */
    private $domainObjectFactory;

    /**
     * @var \Commentar\Storage\Datamapper\Builder Instance of a datamapper factory
     */
    private $dataMapperFactory;

    /**
     * Creates instance
     *
     * @param \Commentar\DomainObject\Builder       $domainObjectFactory Instance of a domain object factory
     * @param \Commentar\Storage\Datamapper\Builder $dataMapperFactory   Instance of a datamapper factory
     */
    public function __construct(DomainObjectBuilder $domainObjectFactory, DatamapperBuilder $dataMapperFactory)
    {
        $this->domainObjectFactory = $domainObjectFactory;
        $this->dataMapperFactory   = $dataMapperFactory;
    }

    /**
     * Builds a service
     *
     * @param string $service   The service to build
     *
     * @return object                                            The service
     * @throws \Commentar\ServiceBuilder\InvalidServiceException When the service could not be loaded
     */
    public function build($service)
    {
        if (strpos($service, '\\') === 0) {
            $fullyQualifiedServiceName = $service;
        } else {
            $fullyQualifiedServiceName = '\\Commentar\Service\\' . $service;
        }

        if (!class_exists($fullyQualifiedServiceName)) {
            throw new InvalidServiceException('The service `' . $fullyQualifiedServiceName . '` is invalid.');
        }

        return new $fullyQualifiedServiceName($this->domainObjectFactory, $this->dataMapperFactory);
    }
}
