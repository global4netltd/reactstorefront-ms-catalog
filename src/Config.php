<?php

namespace G4NReact\MsCatalog;

/**
 * Class Config
 * @package G4NReact\MsCatalog
 */
class Config implements ConfigInterface
{
    const PULLER_PARAM = 'puller';
    const PUSHER_PARAM = 'pusher';

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
    public function getPullerNamespace(): ?string
    {
        return $this->engineParams[self::PULLER_PARAM]['namespace'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getPusherNamespace(): ?string
    {
        return $this->engineParams[self::PUSHER_PARAM]['namespace'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getPullerEngine(): ?int
    {
        return $this->engineParams[self::PULLER_PARAM]['engine'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getPusherEngine(): ?int
    {
        return $this->engineParams[self::PUSHER_PARAM]['engine'] ?? null;
    }

    /**
     * @return array
     */
    public function getPullerEngineParams(): array
    {
        return $this->engineParams[self::PULLER_PARAM];
    }

    /**
     * @param array $params
     * @return ConfigInterface
     */
    public function setPullerEngineParams(array $params): ConfigInterface
    {
        $this->engineParams[self::PULLER_PARAM] = $params;

        return $this;
    }

    /**
     * @return array
     */
    public function getPusherEngineParams(): array
    {
        return $this->engineParams[self::PUSHER_PARAM];
    }

    /**
     * @param array $params
     * @return ConfigInterface
     */
    public function setPusherEngineParams(array $params): ConfigInterface
    {
        $this->engineParams[self::PUSHER_PARAM] = $params;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPullerPageSize(): ?int
    {
        return $this->engineParams[self::PULLER_PARAM]['puller_page_size'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getPusherPageSize(): ?int
    {
        return $this->engineParams[self::PUSHER_PARAM]['pusher_page_size'] ?? null;
    }

    /**
     * @return bool|null
     */
    public function getPusherDeleteIndex(): ?bool
    {
        return $this->engineParams[self::PUSHER_PARAM]['pusher_delete_index'] ?? null;
    }

    /**
     * @return array
     */
    public function getPullerEngineConnectionArray(): array
    {
        return $this->engineParams[self::PULLER_PARAM]['connection'] ?? [];
    }

    /**
     * @return array
     */
    public function getPusherEngineConnectionArray(): array
    {
        return $this->engineParams[self::PUSHER_PARAM]['connection'] ?? [];
    }
}
