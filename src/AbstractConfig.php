<?php

namespace G4NReact\MsCatalog;

/**
 * Class Config
 * @package G4NReact\MsCatalog
 */
abstract class AbstractConfig implements ConfigInterface
{
    /**
     * @var array
     */
    protected $engineParams;

    /**
     * Config constructor
     *
     * @param array $engineParams
     */
    public function __construct(array $engineParams)
    {
        $this->engineParams = $engineParams;
    }

    /**
     * @return string|null
     */
    public function getEngineNamespace(): ?string
    {
        return $this->engineParams['namespace'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getEngine(): ?int
    {
        return $this->engineParams['engine'] ?? null;
    }

    /**
     * @return array
     */
    public function getEngineParams(): array
    {
        return $this->engineParams;
    }

    /**
     * @param array $params
     * @return ConfigInterface
     */
    public function setEngineParams(array $params): ConfigInterface
    {
        $this->engineParams = $params;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPullerPageSize(): ?int
    {
        return $this->engineParams['puller_page_size'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getPusherPageSize(): ?int
    {
        return $this->engineParams['pusher_page_size'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getPullerTimeout(): ?int
    {
        return $this->engineParams['puller_timeout'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getPusherTimeout(): ?int
    {
        return $this->engineParams['pusher_timeout'] ?? null;
    }

    /**
     * @return bool|null
     */
    public function getPusherDeleteIndex(): ?bool
    {
        return $this->engineParams['pusher_delete_index'] ?? null;
    }

    /**
     * @return bool|null
     */
    public function getPusherRemoveMissingObjects(): ?bool
    {
        return $this->engineParams['pusher_remove_missing_objects'] ?? null;
    }

    /**
     * @return array
     */
    public function getEngineConnectionArray(): array
    {
        return $this->engineParams['connection'] ?? [];
    }

    /**
     * @return bool
     */
    public function isDebugEnabled(): bool
    {
        return $this->engineParams['debug_enabled'] ?? false;
    }
}
