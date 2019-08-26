<?php

namespace G4NReact\MsCatalog;

/**
 * Interface PullerInterface
 * @package G4NReact\MsCatalog
 */
interface PullerInterface
{
    /**
     * @param array $ids
     * @return PullerInterface
     */
    public function setIds(array $ids): PullerInterface;

    /**
     * @return array
     */
    public function getIds(): array;

    /**
     * @param QueryInterface|null $query
     * @return ResponseInterface
     */
    public function pull(QueryInterface $query = null): ResponseInterface;
}
