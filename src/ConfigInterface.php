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
     * @return Config
     */
    public function setEngine(int $engine);

    /**
     * @return string
     */
    public function getHost();

    /**
     * @param string $host
     * @return Config
     */
    public function setHost(string $host);

    /**
     * @return int
     */
    public function getPort();
    /**
     * @param int $port
     * @return Config
     */
    public function setPort(int $port);

    /**
     * @return string
     */
    public function getPath();

    /**
     * @param string $path
     * @return Config
     */
    public function setPath(string $path);

    /**
     * @return string
     */
    public function getCore();

    /**
     * @param string $core
     * @return Config
     */
    public function setCore(string $core);

    /**
     * @return int
     */
    public function getPageSize();

    /**
     * @param int $pageSize
     * @return Config
     */
    public function setPageSize(int $pageSize);

    /**
     * @return bool
     */
    public function isClearIndexBeforeReindex();

    /**
     * @param bool $clearIndexBeforeReindex
     * @return Config
     */
    public function setClearIndexBeforeReindex(bool $clearIndexBeforeReindex);

    /**
     * @return array
     */
    public function getConnectionConfigArray();
}
