<?php

namespace G4NReact\MsCatalog;

/**
 * Interface ConfigInterface
 * @package G4NReact\MsCatalog
 */
interface ConfigInterface
{
    /**
     * @return string
     */
    public function getEngine();

    /**
     * @param int $engine
     * @return ConfigInterface
     */
    public function setEngine(int $engine): ConfigInterface;

    /**
     * @return string
     */
    public function getHost();

    /**
     * @param string $host
     * @return ConfigInterface
     */
    public function setHost(string $host): ConfigInterface;

    /**
     * @return int
     */
    public function getPort(): int;

    /**
     * @param int $port
     * @return ConfigInterface
     */
    public function setPort(int $port): ConfigInterface;

    /**
     * @return string
     */
    public function getPath(): string;

    /**
     * @param string $path
     * @return ConfigInterface
     */
    public function setPath(string $path): ConfigInterface;

    /**
     * @return string
     */
    public function getCollection(): string;

    /**
     * @param string $collection
     * @return ConfigInterface
     */
    public function setCollection(string $collection): ConfigInterface;

    /**
     * @return string
     */
    public function getCore(): string;

    /**
     * @param string $core
     * @return ConfigInterface
     */
    public function setCore(string $core): ConfigInterface;

    /**
     * @return int
     */
    public function getPageSize(): int;

    /**
     * @param int $pageSize
     * @return ConfigInterface
     */
    public function setPageSize(int $pageSize): ConfigInterface;

    /**
     * @return bool
     */
    public function isClearIndexBeforeReindex(): bool;

    /**
     * @param bool $clearIndexBeforeReindex
     * @return ConfigInterface
     */
    public function setClearIndexBeforeReindex(bool $clearIndexBeforeReindex): ConfigInterface;

    /**
     * @return array
     */
    public function getConnectionConfigArray(): array;
}
