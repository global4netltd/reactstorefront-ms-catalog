<?php

namespace G4NReact\MsCatalog;

/**
 * Interface QueryBuilder
 * @package G4NReact\MsCatalog
 */
interface QueryBuilderInterface
{
    /**
     * @return QueryInterface
     */
    public function buildQuery();
    
    /**
     * @return QueryInterface
     */
    public function getQuery();
}
