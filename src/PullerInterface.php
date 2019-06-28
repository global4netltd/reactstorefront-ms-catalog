<?php

namespace G4NReact\MsCatalog;

/**
 * Interface PullerInterface
 * @package G4NReact\MsCatalog
 */
interface PullerInterface
{
    /**
     * @param QueryInterface|null $query
     * @return ResponseInterface
     */
    public function pull(QueryInterface $query = null): ResponseInterface;
}
