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
}
