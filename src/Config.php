<?php

namespace G4NReact\MsCatalog;

/**
 * Class Config
 * @package G4NReact\MsCatalog
 */
class Config implements ConfigInterface
{
    /**
     * @var array
     */
    protected $pullerEngineParams;

    /**
     * @var array
     */
    protected $pusherEngineParams;

    /**
     * Config constructor
     *
     * @param array $pullerEngineParams
     * @param array $pusherEngineParams
     */
    public function __construct(array $pullerEngineParams, array $pusherEngineParams)
    {
        $this->pullerEngineParams = $pullerEngineParams;
        $this->pusherEngineParams = $pusherEngineParams;
    }

    /**
     * @return string|null
     */
    public function getPullerNamespace(): ?string
    {
        return $this->pullerEngineParams['namespace'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getPusherNamespace(): ?string
    {
        return $this->pusherEngineParams['namespace'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getPullerEngine(): ?int
    {
        return $this->pullerEngineParams['engine'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getPusherEngine(): ?int
    {
        return $this->pusherEngineParams['engine'] ?? null;
    }

    /**
     * @return array
     */
    public function getPullerEngineParams(): array
    {
        return $this->pullerEngineParams;
    }

    /**
     * @param array $params
     * @return ConfigInterface
     */
    public function setPullerEngineParams(array $params): ConfigInterface
    {
        $this->pullerEngineParams = $params;

        return $this;
    }

    /**
     * @return array
     */
    public function getPusherEngineParams(): array
    {
        return $this->pusherEngineParams;
    }

    /**
     * @param array $params
     * @return ConfigInterface
     */
    public function setPusherEngineParams(array $params): ConfigInterface
    {
        $this->pusherEngineParams = $params;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPullerPageSize(): ?int
    {
        return $this->pullerEngineParams['puller_page_size'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getPusherPageSize(): ?int
    {
        return $this->pusherEngineParams['pusher_page_size'] ?? null;
    }

    /**
     * @return bool|null
     */
    public function getPusherDeleteIndex(): ?bool
    {
        return $this->pusherEngineParams['pusher_delete_index'] ?? null;
    }

    /**
     * @return array
     */
    public function getPullerEngineConnectionArray(): array
    {
        return $this->pullerEngineParams['connection'] ?? [];
    }

    /**
     * @return array
     */
    public function getPusherEngineConnectionArray(): array
    {
        return $this->pusherEngineParams['connection'] ?? [];
    }
}
