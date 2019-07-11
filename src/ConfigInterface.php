<?php

namespace G4NReact\MsCatalog;

/**
 * Interface ConfigInterface
 * @package G4NReact\MsCatalog
 */
interface ConfigInterface
{
    /**
     * @return string|null
     */
    public function getEngineNamespace(): ?string;

    /**
     * @return int|null
     */
    public function getEngine(): ?int;

    /**
     * @return array
     */
    public function getEngineParams(): array;

    /**
     * @param array $params
     * @return ConfigInterface
     */
    public function setEngineParams(array $params): ConfigInterface;

    /**
     * @return int|null
     */
    public function getPullerPageSize(): ?int;

    /**
     * @return int|null
     */
    public function getPusherPageSize(): ?int;

    /**
     * @return bool|null
     */
    public function getPusherDeleteIndex(): ?bool;

    /**
     * @return array
     */
    public function getEngineConnectionArray(): array;
}
