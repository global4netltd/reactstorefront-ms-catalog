<?php

namespace G4NReact\MsCatalog;

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
}
