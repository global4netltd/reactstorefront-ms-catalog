<?php

namespace G4NReact\MsCatalog;

use Exception;
use G4NReact\MsCatalog\QueryInterface as MsCatalogQueryInterface;

/**
 * Class Response
 * @package G4NReact\MsCatalog
 */
class Response extends AbstractResponse
{
    /**
     * @param $query
     * @return ResponseInterface
     */
    public function setQuery($query)
    {
        return $this;
    }

    /**
     * @return MsCatalogQueryInterface|string
     * @throws Exception
     */
    public function getQuery()
    {
        return '';
    }

    /**
     * @param array $debugInfo
     * @return ResponseInterface
     */
    public function setDebugInfo(array $debugInfo): ResponseInterface
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getDebugInfo(): array
    {
        return [];
    }
}
