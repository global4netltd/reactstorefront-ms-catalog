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
    public function getPullerNamespace(): ?string;

    /**
     * @return string|null
     */
    public function getPusherNamespace(): ?string;

    /**
     * @return int|null
     */
    public function getPullerEngine(): ?int;

    /**
     * @return int|null
     */
    public function getPusherEngine(): ?int;

    /**
     * @return array
     */
    public function getPullerEngineParams(): array;

    /**
     * @param array $params
     * @return ConfigInterface
     */
    public function setPullerEngineParams(array $params): ConfigInterface;

    /**
     * @return array
     */
    public function getPusherEngineParams(): array;

    /**
     * @param array $params
     * @return ConfigInterface
     */
    public function setPusherEngineParams(array $params): ConfigInterface;

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
    public function getPullerEngineConnectionArray(): array;

    /**
     * @return array
     */
    public function getPusherEngineConnectionArray(): array;
}
