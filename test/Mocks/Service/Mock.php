<?php

namespace CommentarTest\Mocks\Service;

use Commentar\DomainObject\Builder as DomainObjectBuilder;
use Commentar\Storage\Datamapper\Builder as DatamapperBuilder;

class Mock
{
    /**
     * Creates instance
     *
     * @param \Commentar\DomainObject\Builder       $domainObjectFactory Instance of a domain object factory
     * @param \Commentar\Storage\Datamapper\Builder $datamapperFactory   Instance of a datamapper factory
     */
    public function __construct(DomainObjectBuilder $domainObjectFactory, DatamapperBuilder $datamapperFactory)
    {
    }
}
