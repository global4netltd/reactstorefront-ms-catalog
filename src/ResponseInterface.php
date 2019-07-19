<?php

namespace G4NReact\MsCatalog;

use Exception;
use G4NReact\MsCatalog\QueryInterface as MsCatalogQueryInterface;
use G4NReact\MsCatalogSolr\Response;

/**
 * Interface ResponseInterface
 */
interface ResponseInterface
{
    /**
     * @return int
     */
    public function getNumFound(): int;

    /**
     * @param int $numFound
     * @return ResponseInterface
     */
    public function setNumFound(int $numFound): ResponseInterface;

    /**
     * @return Document[]
     */
    public function getDocumentsCollection(): array;

    /**
     * @param array $documentsCollection
     * @return ResponseInterface
     */
    public function setDocumentsCollection(array $documentsCollection): ResponseInterface;

    /**
     * @return Document
     */
    public function getFirstItem(): Document;

    /**
     * @return array|null
     */
    public function getFacets(): ?array;

    /**
     * @param array $facets
     * @return ResponseInterface
     */
    public function setFacets(array $facets): ResponseInterface;

    /**
     * @return array|null
     */
    public function getStats(): ?array;

    /**
     * @param array $stats
     * @return ResponseInterface
     */
    public function setStats(array $stats): ResponseInterface;

    /**
     * @return int
     */
    public function getCurrentPage(): int;

    /**
     * @param int $currentPage
     * @return ResponseInterface
     */
    public function setCurrentPage(int $currentPage): ResponseInterface;

    /**
     * @param int $statusCode
     * @return ResponseInterface
     */
    public function setStatusCode(int $statusCode): ResponseInterface;

    /**
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * @param string $statusMessage
     * @return ResponseInterface
     */
    public function setStatusMessage(string $statusMessage): ResponseInterface;

    /**
     * @return string
     */
    public function getStatusMessage(): string;

    /**
     * @param $query
     * @return Response
     */
    public function setQuery($query);

    /**
     * @return MsCatalogQueryInterface|String
     * @throws Exception
     */
    public function getQuery();

    /**
     * @param array $debugInfo
     * @return ResponseInterface
     */
    public function setDebugInfo(array $debugInfo): ResponseInterface;

    /**
     * @return array
     */
    public function getDebugInfo(): array;
}
